<?php
    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/HoaDonController.php");
    require_once("../../Controller/UserController.php");
    $username = '';
    if (isset($_SESSION['UserName'])) {
        $username = $_SESSION['UserName'];
    }
    $idEmployee = (new UserController())->getIdEmployee($username);
    $msg = $msgEmail = $error = '';
    
?>
<div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <div class="main-panel">
            

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
       
        </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Thông tin nhân viên <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
   
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
   
                    <h4><span><?php echo $msg; ?></span></h4>
                    <h4><span><?php echo $msgEmail; ?></span></h4>
                    <h4><span><?php echo $error; ?></span></h4>
                    	
                    <div class="col-lg-12">
                    <form class="pt-3" method = "post"  action=""  enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Mã nhân viên</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo  $idEmployee->MaNhanVien; ?>" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Tên nhân viên</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo  $idEmployee->TenNhanVien; ?>" name="model">
                        </div>
                        <div class="form-group">
                            <label for="">Ngày sinh</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php
                             if( $idEmployee->NgaySinh == '') {
                                echo "Chưa cập nhật thông tin";
                            } else {
                                echo  $idEmployee->NgaySinh;
                            }
                             
                              ?> "name="weight">
                        </div>
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php 
                            if( $idEmployee->SoDienThoai1 == '') {
                                echo "Chưa cập nhật thông tin";
                            } else {
                                echo $idEmployee->SoDienThoai1; 
                            }
                          
                            ?>" name="dactinh">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php 
                            if($idEmployee->DiaChi == '') {
                                echo "Chưa cập nhật thông tin";
                            } else {
                                echo  $idEmployee->DiaChi;
                            }
                            
                            ?>" name="ten">
                        </div>
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php
                             if($idEmployee->ChucVu == '') {
                                echo "Chưa cập nhật thông tin";
                            } else {
                                echo  $idEmployee->ChucVu; 
                            }
                           
                              ?>" name="thoigianbaohanh">
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php 
                            
                            if($idEmployee->AnhDaiDien == '') {
                                echo "Chưa cập nhật thông tin";
                            } else {
                                echo  $idEmployee->AnhDaiDien; 
                            }
                            ?>" name="gioithieu">
                        </div>
                        <div class="form-group">
                            <label for="">Thông tin</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php
                             if($idEmployee->GhiChu == '') {
                                echo "Chưa cập nhật thông tin";
                            } else {
                                echo  $idEmployee->GhiChu; 
                            }
                            
                             ?>" name="chietkhau">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo  $idEmployee->Email; ?>" name="chietkhau">
                        </div>
                        <div class="form-group">
                        <label  class="form-control form-control-lg" for="file">Select image to upload:</label>
                        <input  class="form-control form-control-lg" type="file" name="file" id="file">
                       
                        </div>
                        <!-- <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Giá nhập" name="gianhap">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Giá bán" name="giaban">
                        </div> -->
                        <!-- <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Chất liệu" name="chatlieu">
                        </div> -->
                        <!-- <select class="form-control form-control-lg" name="chatlieu" id="cars">
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
                           
                        </select> -->
                        <div class="mt-3 d-flex justify-content-center">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn " name="btnSignUp" href="">Cập nhật thông tin</button>
                        </div>
                    </form>
                        <a href="../User/indexHome.php" class="d-flex justify-content-center">Return</a>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>  