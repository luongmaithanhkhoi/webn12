<?php

	require_once("../../Data/db.php");
    require_once("../../Models/Account.php");
    require_once("../../Models/Customer.php");
    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/ProductDetailController.php");
    $loaiSP = (new ProductController())->loadLoaiSanPham();
   
    $loaiDT = (new ProductController())->loadLoaiDacTinh();
    $hangSX = (new ProductController())->loadHangSanXuat();
    $chatLieu = (new ProductController())->loadChatLieu();

	$us ='';
	$error = '';
	$msg = '';
    $msgEmail = '';
	$name = $model = $weight = $dactinh = $ten = $thoigianbaohanh = $gioithieu = $chietkhau = $file = $gianhap = $giaban = $chatlieu = $loaisanpham = $dactinh = $hangsanxuat= "";
	if(isset($_POST['btnSignUp'])){
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		if(isset($_POST['model'])) {
		    $model = $_POST['model'];
		}
        if(isset($_POST['weight'])) {
			$weight = $_POST['weight'];
		}
		if(isset($_POST['dactinh'])) {
		    $dactinh = $_POST['dactinh'];
		}
        if(isset($_POST['ten'])) {
			$ten = $_POST['ten'];
		}
		if(isset($_POST['thoigianbaohanh'])) {
		    $thoigianbaohanh = $_POST['thoigianbaohanh'];
		}
        if(isset($_POST['gioithieu'])) {
			$gioithieu = $_POST['gioithieu'];
		}
		if(isset($_POST['chietkhau'])) {
		    $chietkhau = $_POST['chietkhau'];
		}
        if(isset($_POST['file'])) {
			$file = $_POST['file'];
		}
		if(isset($_POST['gianhap'])) {
		    $gianhap = $_POST['gianhap'];
		}
        if(isset($_POST['giaban'])) {
			$giaban = $_POST['giaban'];
		}
		if(isset($_POST['chatlieu'])) {
		    $chatlieu = $_POST['chatlieu'];
		}
        if(isset($_POST['loaisanpham'])) {
			$loaisanpham = $_POST['loaisanpham'];
		}
		if(isset($_POST['dactinh'])) {
		    $dactinh = $_POST['dactinh'];
		}
        if(isset($_POST['hangsanxuat'])) {
			$hangsanxuat = $_POST['hangsanxuat'];
		}
        $anh = $_FILES['file']['name'];
        $currentDateTime = date('Y-m-d H:i:s');
        if(filter_has_var(INPUT_POST,'btnSignUp')) {
            $sql = "INSERT INTO `danhmucsanphams` (`TenSP`, `Model`, `CanNang`,`MaDacTinh`,
            `TenSpShort`, `NgayDang`, `NgayChinhSua`,`ThoiGianBaoHanh`, `GioiThieuSanPham`, `ChieuKhau`
            , `AnhDaiDien`,`GiaLonNhat` ,`GiaNhoNhat`, `MaChatLieu`, `MaLoaiSp`
            , `MaDT`,`MaHangSX`) 
            VALUES ('$name','$model','$weight', '$dactinh','$ten',  '$currentDateTime', '$currentDateTime','$thoigianbaohanh', '$gioithieu','$chietkhau'
            ,'$anh', '$gianhap','$giaban','$chatlieu','$loaisanpham','$dactinh','$hangsanxuat')"; 
            $result = mysqli_query($conn,$sql);
            if($result) {
        
                $sql_max = "SELECT MAX(MaSP) AS max_masp FROM danhmucsanphams";
                $result_max = $conn->query($sql_max);
                $row_max = $result_max->fetch_assoc();
                $maxMaSP = $row_max['max_masp'];
                $msg = 'Thêm sản phẩm thành công';
               

                $sqlnew = "INSERT INTO `chitietsanphams` (`MaSp`, `AnhDaiDien`, `MaMauSac`, `MaKichThuoc`) 
           VALUES ('$maxMaSP', '$anh', '16', '14')";
                $results = mysqli_query($conn, $sqlnew);
              
            }
            else {
                $error = 'Thêm sản phẩm thất bại';
            }
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

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        // Directory where the image will be saved
        $uploadDir = '../../Style/User/img/featured/';

        // Ensure the directory exists, create it if not
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // File path of the uploaded image
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);

        // Move the uploaded image to the specified directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            // echo "Image uploaded successfully.";
        } else {
            // echo "Error uploading image.";
        }
    } else {
        echo "Please select an image to upload.";
    }
?>



<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Thêm sản phẩm
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
                    <h4 class="card-title d-flex justify-content-center" >Thông tin sản phẩm</h4>
                    <h4><span><?php echo $msg; ?></span></h4>
                    <h4><span><?php echo $msgEmail; ?></span></h4>
                    <h4><span><?php echo $error; ?></span></h4>
                    	
                    <div class="col-lg-12">
                    <form class="pt-3" method = "post"  action=""  enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Tên sản phẩm" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Model" name="model">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Cân nặng" name="weight">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Đặc tính" name="dactinh">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Tên sản phẩm ngắn" name="ten">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Thời gian bảo hành" name="thoigianbaohanh">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Giới thiệu về sản phẩm" name="gioithieu">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Chiếu khấu" name="chietkhau">
                        </div>
                        <div class="form-group">
                        <label  class="form-control form-control-lg" for="file">Select image to upload:</label>
                        <input  class="form-control form-control-lg" type="file" name="file" id="file">
                       
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Giá nhập" name="gianhap">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Giá bán" name="giaban">
                        </div>
                        <!-- <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Chất liệu" name="chatlieu">
                        </div> -->
                        <select class="form-control form-control-lg" name="chatlieu" id="cars">
                            <?php 
                            foreach($chatLieu as $lsp) {
                                ?>
                                
                                <option class="form-control form-control-lg" value="<?php echo $lsp->MaChatLieu ?>"><?php echo $lsp->TenChatLieu ?></option>
                                <?php
                            }
                            ?>
                           
                        </select>
                        <br>
                   
                        <select class="form-control form-control-lg" name="loaisanpham" id="cars">
                            <?php 
                            foreach($loaiSP as $lsp) {
                                ?>
                                
                                <option class="form-control form-control-lg" value="<?php echo $lsp->MaLoaiSp ?>"><?php echo $lsp->LoaiSp ?></option>
                                <?php
                            }
                            ?>
                           
                        </select>
                        <br>
                      
                        <select class="form-control form-control-lg" name="dactinh" id="cars">
                            <?php 
                            foreach($loaiDT as $lsp) {
                                ?>
                                
                                <option class="form-control form-control-lg" value="<?php echo $lsp->MaDT ?>"><?php echo $lsp->TenLoaiDT ?></option>
                                <?php
                            }
                            ?>
                           
                        </select>
                        <br>
                
                        <select class="form-control form-control-lg" name="hangsanxuat" id="cars">
                            <?php 
                            foreach($hangSX as $lsp) {
                                ?>
                                
                                <option class="form-control form-control-lg" value="<?php echo $lsp->MaHangSX ?>"><?php echo $lsp->TenHangSX ?></option>
                                <?php
                            }
                            ?>
                           
                        </select>
                        <div class="mt-3 d-flex justify-content-center">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn " name="btnSignUp" href="">Thêm sản phẩm</button>
                        </div>
                    </form>
                        <a href="../Admin/index.php?page_layout=ManagerProduct" class="d-flex justify-content-center">Return</a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>