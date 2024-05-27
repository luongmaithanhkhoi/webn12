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
                                  Mã chi tiết sản phẩm
                                    </th>
                                    <th  class="text-center">
                                   Số lượng tồn kho
                                    </th>
                                    <th  class="text-center">
                                   Màu sắc	
                                    </th>
                                    <th  class="text-center">
                                  Kích thước
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
                                     
                                                echo $list->SoDienThoai1;
                                                ?>
                                                
                                            </td>
                                            <td>
                                                <?php
                                                  echo $list->DiaChi; 
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
            </div>
        </div>
    </div>
</div>