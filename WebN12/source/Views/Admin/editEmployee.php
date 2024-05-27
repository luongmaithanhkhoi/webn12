<?php

    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/HoaDonController.php");
    require_once("../../Controller/UserController.php");
    $ids = '';
    if(isset($_GET['id'])) {
        $ids = $_GET['id'];
     
    }
    $status = '';
    $lock = '';
    $employee = (new UserController())->login($ids);
    if($employee->Khoa ==1) {
        $lock = 'Lock';
    } else {
        $lock = 'Unlock';
    }
    if($employee->Active ==1) {
        $status = 'Active';
    } else {
        $status = 'InActive';
    }
?>
<?php
    $msg ='';
    if(isset($_POST['btnSave'])) {
        $active = $_POST['status'];
        $c ='';
        if($active == 'active' || $active == '1') {
            $c = 1;
        }
        if($active == 'inactive' || $active == '0') {
            $c = 0;
        }
        $lockUnlock = $_POST['lock'];
        $cs ='';
        if($lockUnlock == 'lock' || $lockUnlock == '1') {
            $cs = 1;
        }
        if($lockUnlock == 'unlock' || $lockUnlock == '0') {
            $cs = 0;
        }
   
        if(isset($active)) {
            // echo $diachi;
            // echo $ngaysinh;
            $sql = "UPDATE `account` 
            SET `Active` = ?, `Khoa` = ?
            WHERE `UserName` = ?";
    
            if ($stmt = $conn->prepare($sql)) {
                // Assuming $tenkhachhang, $ngaysinh, $sdt, $diachi, $email, and $ids are defined earlier
                $stmt->bind_param("iis",  $c,$cs, $ids);
                
                // Execute the statement
                if ($stmt->execute()) {
                    
                    $msg =  "Thay đổi thông tin thành công";
                   
                } else {
                    // Handle execution error
                    die('Execute error: ' . htmlspecialchars($stmt->error));
                }
            
                // Close the statement
                $stmt->close();
            } else {
                // Handle preparation error
                die('Prepare error: ' . htmlspecialchars($conn->error));
            }
        }
    }
?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Thay đổi thông tin 
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
                    <h4 class="card-title d-flex justify-content-center" >Thông tin tài khoản</h4>
                    <h4><span><?php echo $msg; ?></span></h4>
                    <div class="col-lg-12">
                        <form method="post" asp-action="SuaKhachHang">
                            <div class="form-group">
                                <label asp-for="Password" class="control-label">Trạng thái tài khoản</label> <br>
                                <label asp-for="Password" class="control-label">Input: inactive = 0 /active = 1</label>
                                <input type="text" asp-for="Password" class="form-control" name="status" value="" placeholder="<?php echo  $status ?>"/>
                                <span asp-validation-for="Password" class="primary-danger"></span>
                            </div> 
                            <div class="form-group">
                             
                                <label asp-for="Password" class="control-label">Input: unlock = 0 /lock = 1</label>
                                <input type="text" asp-for="Password" class="form-control" name="lock" value="" placeholder="<?php echo  $lock ?>"/>
                                <span asp-validation-for="Password" class="primary-danger"></span>
                            </div> 
                            <div class="form-group d-flex justify-content-center" >
                                <button type="submit" value="Save" name="btnSave" class="btn btn-primary" button> Save
                                
                            </div>
                           
         
                        </form>
                        <a href="../Admin/index.php?page_layout=ManagerEmployee" class="d-flex justify-content-center">Return</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>