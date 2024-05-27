<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
	require_once("../../Data/db.php");
    require_once("../../Models/Account.php");
    require_once("../../Models/Customer.php");
	$us ='';
	$error = '';
	$msg = '';
    $msgEmail = '';
	$name = $email = $pass = $fullname = "";
	if(isset($_POST['btnSignUp'])){
		if(isset($_POST['email'])) {
			$email = $_POST['email'];
		}
		if(isset($_POST['fullname'])) {
		    $fullname = $_POST['fullname'];
		}
    $name = getUsername($email);
    $pwd_hashed = password_hash($name, PASSWORD_DEFAULT);
    require_once("../../Controller/AccessController.php");
    $user = (new AccessController())->checkUsername($name);
    $userEmail =(new AccessController())->checkEmail($email);
    $employeeEmail =(new AccessController())->checkEmailEmployee($email);
 
    if ($user->UserName === $name) {
        $error = 'Email đã được sử dụng';
       
    } else if ($userEmail->Email == $email  ||  $employeeEmail->Email == $email) {
        $error = 'Email đã được sử dụng';
    
    }
    else {
        if(filter_has_var(INPUT_POST,'btnSignUp')) {
            $role = 3; /// role users
            $sql = "INSERT INTO `account` (`username`, `password`, `loaiuser`, `active`,  `vialink`) VALUES ('$name','$pwd_hashed','$role', 1, 0)";
            $result = mysqli_query($conn,$sql);
            if($result) {
                $msg = 'Tạo tài khoản thành công';
                $sql = "INSERT INTO `nhanviens` (`TenNhanVien`, `UserName`, `Email`) VALUES ('$fullname', '$name', '$email')";
                $result = mysqli_query($conn,$sql);
                $msgEmail = sendMail($email, $name);
                
            } else {
                $msg = 'Tạo tài không khoản thành công';
            } 
            }
            else {
                $error = 'Bạn phải đồng ý với các điều khoản';
            }
        }	
	}
?>
<?php
    function sendMail($email, $name) {  
        //Load Composer's autoloader
        // require '../vendor/autoload.php';
        require '../../Controller/PHPMailer/src/Exception.php';
        require '../../Controller/PHPMailer/src/PHPMailer.php';
        require '../../Controller/PHPMailer/src/SMTP.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $result = '';
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->SMTPDebug = 0;                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'thanhkhoi939@gmail.com';                     //SMTP username
            $mail->Password   = 'dffloxypfhafgkrz';                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPSecure = 'tls';              //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('thanhkhoi939@gmail.com', 'WESTORE');
            $mail->addAddress($email,  $name);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'Bạn đã tạo tài khoản thành công <br> <a href="http://localhost/WebN12/source/Views/Access/login.php?ViaLink=vialink&id='. $name .'">Đăng nhập vào website</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $result = 'Email đã được gửi';
            return $result;
        } catch (Exception $e) {
            $result =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return $result;
}
    }

?>
<?php
    function getUsername(string $value) {
      $parts = explode('@', $value);
      $userName = $parts[0];
      return $userName;
    }
?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Thêm nhân viên
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
   
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <h4 class="card-title d-flex justify-content-center" >Thông tin nhân viên</h4>
                    <h4><span><?php echo $msg; ?></span></h4>
                    <h4><span><?php echo $msgEmail; ?></span></h4>
                    <h4><span><?php echo $error; ?></span></h4>
                    
                    <div class="col-lg-12">
                    <form class="pt-3" method = "post" action="#">
                        <!-- <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" name="name">
                        </div> -->
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Fullname" name="fullname">
                        </div>
                    
                        <div class="mt-3 d-flex justify-content-center">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn " name="btnSignUp" href="">Tạo tài khoản</button>
                        </div>
                       
                    </form>
                        <a href="../Admin/index.php?page_layout=ManagerEmployee" class="d-flex justify-content-center">Return</a> 
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>