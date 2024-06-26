<?php
    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/HoaDonController.php");
    require_once("../../Controller/UserController.php");
    $numberAccounts = (new UserController())->loadInfoAccountEmployee();
?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
            
        </span> Quản lý tài khoản
     
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
    <div  class="d-flex justify-content-center"> <a href="../Admin/index.php?page_layout=addEmployee">Thêm nhân viên</a> </div>
        <div class="col-lg-12 stretch-card">
            <div class="card">
                
                <div class="card-body table-responsive">
                        <h4 class="card-title d-flex justify-content-center" >Thông tin các tài khoản</h4>
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                                <tr class="table-warning" style="width: 30%">
                                    <th  class="text-center">
                                        Username
                                    </th>
                                    <th  class="text-center">
                                        Loại tài khoản
                                    </th>
                                    <th  class="text-center">
                                       Trạng thái
                                    </th>
                                    <th  class="text-center">
                                       Lock/Unlock
                                    </th>
                                    
                                    <th  class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($numberAccounts as $list) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $list->UserName ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($list->LoaiUser== 1) {
                                                        echo "Admin";
                                                    } 
                                                    if($list->LoaiUser== 0) {
                                                        echo "Khách hàng";
                                                    } 
                                                    if($list->LoaiUser== 3) {
                                                        echo "Nhân viên";
                                                    } 
                                                
                                                    ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    if($list->Active== 1) {
                                                        echo "Active";
                                                    } else {
                                                        echo "InActive";
                                                    }
                                                
                                                    ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    if($list->Khoa== 0) {
                                                        echo "Unlock";
                                                    } else {
                                                        echo "Lock";
                                                    }
                                                
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="../Admin/index.php?page_layout=detailEmployee&id=<?php echo$list->UserName ?>">Details</a> |
                                                    <a href="../Admin/index.php?page_layout=editEmployee&id=<?php echo$list->UserName ?>">Edits</a> |
                                                    <a href="../Admin/index.php?page_layout=sendEmail&id=<?php echo$list->UserName ?>">Send Email</a> 
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