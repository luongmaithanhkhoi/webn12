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
    $detailEmployee = (new UserController())->loadInfoEmployee($id);
    $MaNhaVien = '';
    foreach($detailEmployee as $a) {
        $MaNhaVien = $a->MaNhanVien;
    }
    $billEmployee = (new HoaDonController())-> getBillInfoByIdEmployee($MaNhaVien);
   
?>
<?php

function getStringValue(float $value) {
    $a = (string)$value;
    $length = strlen($a);
    $a = substr_replace($a, ".", $length - 3, 0);
    if ($length > 9) {
        $a = substr_replace($a, ".", $length - 9, 0);
    }
    if ($length > 6) {
        $a = substr_replace($a, ".", $length - 6, 0);
    }
    return $a;
}
?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Quản lý nhân viên
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
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                                <tr class="table-warning" style="width: 30%">
                                    <th  class="text-center">
                                   Mã Nhân Viên
                                    </th>
                                    <th  class="text-center">
                                   Họ Tên
                                    </th>
                                    <th  class="text-center">
                                   Ngày Sinh	
                                    </th>
                                    <th  class="text-center">
                                  Số điện thoại
                                    </th>
                                    <th  class="text-center">
                                  Địa chỉ
                                    </th>
                                  
                                    <th  class="text-center">
                                  Email
                                    </th>
                                   
                                    <th  class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($detailEmployee as  $list) {
                                    ?>
                                        <tr>
                                            <td>
                                            <?php
                                     
                                                echo $list->MaNhanVien;
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                  echo $list->TenNhanVien; 
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                  echo $list->NgaySinh; 
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                if($list->SoDienThoai1 == null) {
                                                    echo "Chưa cập nhật thông tin";
                                                } else {
                                                    echo $list->SoDienThoai1;
                                                }
                                               
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                 if($list->SoDienThoai1 == null) {
                                                    echo "Chưa cập nhật thông tin";
                                                } else {
                                                    echo $list->DiaChi;
                                                }
                                               
                                                  
                                                ?>
                                            </td>
                                          
                                            <td>
                                            <?php
                                                  echo $list->Email; 
                                                ?>
                                            </td>
                                            <td>
                                                <a href="../Admin/index.php?page_layout=ManagerEmployee">Return</a> 
                                                <!-- <a href="../Admin/index.php?page_layout=editCustomerInfo&id=">Edits</a>  -->
                                            </td>
                                        </tr>
                                    <?php
                                     }
                                ?>
                            </tbody>
                    </table>          
                </div>

                <br>
                <div class="card-body table-responsive">
                        <h4 class="card-title d-flex justify-content-center" >Thông tin các đơn hàng</h4>
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                                <tr class="table-warning" style="width: 30%">
                                    <th  class="text-center">
                                   Mã đơn hàng
                                    </th>
                                    <th  class="text-center">
                                  Ngày lập hoá đơn
                                    </th>
                                  
                                    <th  class="text-center">
                                 Tổng tiền
                                    </th>
                                    <th  class="text-center">
                                  Tình trạng đơn hàng
                                    </th>
                                    <th  class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($billEmployee as  $list) {
                                    ?>
                                        <tr>
                                            <td>
                                            <?php
                                                
                                                echo $list->MaHoaDon;
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                  echo $list->NgayTaoHoaDon; 
                                                ?>
                                            </td>
                                        
                                            <td>
                                            <?php
                                     
                                                echo getStringValue($list->TongTien);
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                  echo $list->TinhTrang; 
                                                ?>
                                            </td>
                                            <td>
                                                <a href="../Admin/index.php?page_layout=ManagerEmployee">Return</a> |
                                                <a href="../Admin/index.php?page_layout=detailBill&id=<?php echo$list->MaHoaDon?>">Details</a> 
                                            </td>
                                        </tr>
                                    <?php
                                     }
                                ?>
                            </tbody>
                    </table>          
                </div>
            </div>
        </div>
    </div>
</div>