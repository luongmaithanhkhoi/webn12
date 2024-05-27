<?php

	require_once("../../Data/db.php");
    require_once("../../Models/Account.php");
    require_once("../../Models/Customer.php");
    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/ProductDetailController.php");
    require_once("../../Controller/ChiTietHoaDonController.php");
    $loaiSP = (new ProductController())->loadLoaiSanPham();
    $id = '';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $status = 0;
    $loaiDT = (new ProductController())->loadLoaiDacTinh();
    $hangSX = (new ProductController())->loadHangSanXuat();
    $chatLieu = (new ProductController())->loadChatLieu();
    $infoProduct = (new ProductController())-> getNameMaSP($id);
    $MASP= (new ProductDetailController())-> getIdProductDetail($id);
    $infoBill = (new ChiTietHoaDonController())-> listOrderByMaSp($MASP->MaChiTietSanPham);
  
    // echo $MASP->MaChiTietSanPham;

    foreach( $infoBill as $list) {
        echo $list->MaHoaDon;
      
        if($list->MaHoaDon !='') {
            $status = 1;
        } 
    }
    
	$us ='';
	$error = '';
	$msg = '';
    $msgEmail = '';
	
	
?>
<?php
    function getUsername(string $value) {
      $parts = explode('@', $value);
      $userName = $parts[0];
      return $userName;
    }
?>
<?php
 if(isset($_POST['btnSignUp'])) {
    $sql1 = "DELETE FROM `chitietsanphams` WHERE `MaSP` = ?";
    $sql = "DELETE FROM `danhmucsanphams` WHERE `MaSP` = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql1);
    
    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $id);
        // Execute the statement
        $result = $stmt->execute();
        // Check the result of the execution
        if ($result) {
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                // Bind the parameter
                $stmt->bind_param("i", $id);
                // Execute the statement
                $result2 = $stmt->execute();
                if($result2) {
                    $msg = 'Xóa sản phẩm thành công';
                }
            }  
        } else {
            $error = 'Xóa sản phẩm thất bại: ' . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        $error = 'Statement preparation failed: ' . $conn->error;
    }
}
?>


<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Xoá sản phẩm
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
                    <h4 class="card-title d-flex justify-content-center" >
                        <?php 
                        if(  $status == 1) {
                            echo "Không thể xoá";
                        } else {
                            echo "Có thể xoá";
                        }
                     ?> Thông tin sản phẩm</h4>
                    <h4><span><?php echo $msg; ?></span></h4>
                    <h4><span><?php echo $msgEmail; ?></span></h4>
                    <h4><span><?php echo $error; ?></span></h4>
                    	
                    <div class="col-lg-12">
                    <form class="pt-3" method = "post"  action=""  enctype="">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo $infoProduct->TenSP ?>" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo $infoProduct->Model ?>" name="model">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo $infoProduct->CanNang ?>" name="weight">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo $infoProduct->MaDacTinh?>" name="dactinh">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo $infoProduct->TenSpShort?>" name="ten">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo $infoProduct->ThoiGianBaoHanh?>" name="thoigianbaohanh">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo $infoProduct->GioiThieuSanPham?>" name="gioithieu">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo $infoProduct->ChieuKhau?>" name="chietkhau">
                        </div>
                        <div class="form-group">
                        <label  class="form-control form-control-lg" for="file">Select image to upload:</label>
                        <input  class="form-control form-control-lg" type="file" name="file" id="file">
                       
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo $infoProduct->GiaNhoNhat?>" name="gianhap">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo $infoProduct->GiaLonNhat?>" name="giaban">
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
                       
                    </form>
                    <form action="" method ="post">
                    <?php 
                            if(  $status == 1) {
                             
                            } else {
                                ?>
                                 <div class="mt-3 d-flex justify-content-center">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn " name="btnSignUp" href="">Xoá</button>
                        </div>
                           
                              <?php
                            }
                        ?>
                    </form>
                       
                        <a href="../Admin/index.php?page_layout=ManagerProduct" class="d-flex justify-content-center">Return</a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>