<?php
    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/HoaDonController.php");
    require_once("../../Controller/UserController.php");
    require_once("../../Controller/ChiTietHoaDonController.php");
    require_once("../../Controller/ProductDetailController.php");
    require_once("../../Controller/ProductDetailController.php");
    $id = '';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $result ='';
    $detailEmployee = (new UserController())->loadInfoEmployee($id);
    foreach($detailEmployee as $list) {
        $result = sendMail($list->Email, $id);
    }
   

?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
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
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Gửi mail
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
                        <h4 class="card-title d-flex justify-content-center" ><?php echo $result ?> tới tài khoản nhân viên <?php echo $id ?></h4>     
                        <a href="../Admin/index.php?page_layout=ManagerEmployee" class="d-flex justify-content-center">Return</a>         
                </div>
            </div>
        </div>
    </div>
</div>