<?php
    require_once("../../Controller/ProductController.php");
    require_once("../../Controller/HoaDonController.php");
    require_once("../../Controller/UserController.php");
    $numberProducts = (new ProductController())->loadInfoProduct();
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
        </span> Quản lý sản phẩm
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
    <div  class="d-flex justify-content-center"> <a href="../Admin/index.php?page_layout=addProduct">Thêm sản phẩm</a> </div>
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                        <h4 class="card-title d-flex justify-content-center" >Thông tin các sản phẩm</h4>
                        <table class="table table-bordered table-striped table-hover table-condensed">
                            <thead>
                                <tr class="table-warning" style="width: 30%">
                                    <th  class="text-center">
                                       Tên Sản Phẩm
                                    </th>
                                    <th  class="text-center">
                                       Loại Sản Phẩm
                                    </th>
                                    <th  class="text-center">
                                        Thời gian bảo hành
                                    </th>

                                    <th  class="text-center">
                                       Giá bán 
                                    </th>

                                    <th  class="text-center">
                                       Giá gốc
                                    </th>
                                    <th  class="text-center">
                                       Ảnh sản phẩm 
                                    </th>
                                    <th  class="text-center">
                                      Cân nặng
                                    </th>
                                    <th  class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($numberProducts as $list) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $list->TenSpShort ?>
                                                </td>
                                                <td>
                                                <?php echo $list->Model ?>
                                                </td>
                                                <td>
                                                <?php echo $list->ThoiGianBaoHanh ?>
                                                </td>
                                                <td>
                                                <?php echo getStringValue($list->GiaNhoNhat) ?>
                                                </td>
                                                <td>
                                                <?php echo getStringValue($list->GiaLonNhat) ?>
                                                </td>
                                                <td>
                                                    <img src="../../Style/User/img/featured/<?php echo $list->AnhDaiDien?>" alt="" style="background-size: contain,  cover;">
                                                </td>
                                                <td>
                                                <?php echo $list->CanNang ?>
                                                </td>
                                               
                                                <td>
                                                    <a href="../Admin/index.php?page_layout=detailProduct&id=">Details</a> |
                                                    <a href="../Admin/index.php?page_layout=editProduct&id=<?php echo  $list->MaSP; ?>">Edits</a>  |
                                                    <a href="../Admin/index.php?page_layout=deleteProduct&id=<?php echo  $list->MaSP; ?>">Delete</a> 
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