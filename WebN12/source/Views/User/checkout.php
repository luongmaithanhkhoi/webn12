<?php 
    require_once("../../Data/db.php");  
    $msg = '';
    if(isset($_POST['btnOrder'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
      
        if(isset($firstName) && isset($lastName) && isset($address) && isset($city) && isset($phone) && isset($email)) {
            $fullName =  $lastName . '' . $firstName;

            if(filter_has_var(INPUT_POST,'btncheck'))  {
                if($_SESSION['LoaiUser'] === 3) {
                 
                    $role = 0; /// role users
                   
                    $pwd_hashed = password_hash($fullName , PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `account` (`username`, `password`, `loaiuser`, `active`,  `vialink`) VALUES ('$fullName','$pwd_hashed','$role', '1', '1')";
                    $result = mysqli_query($conn,$sql);
                    if($result) {
                        $msg = 'Tạo tài khoản thành công';
                        $sql = "INSERT INTO `customer` (`UserName`, `Email`) VALUES ('$fullName', '$email')";
                        $result = mysqli_query($conn,$sql);
                    } 
                    else {
                    $msg = 'Tạo tài không khoản thành công';
                    } 
                }
            }
            require_once("../../Controller/ProductController.php");
            if(isset($_SESSION['shopcart'])) {
                $arrId = array();
                $totalPrice= 0;
                foreach($_SESSION['shopcart'] as $id_sp =>$so_luong) {
                    $infoProducts = (new ProductController())->loadInfoProductById($id_sp);
                    foreach($infoProducts as $product) {
                        $totalPrice += $product->GiaNhoNhat * $_SESSION['shopcart'][$product->MaSP]; 
                        
                        $total = $product->GiaNhoNhat * $_SESSION['shopcart'][$product->MaSP];
                        // echo getStringValue($total);
                    }          
                } 

                require_once("../../Controller/UserController.php");
               
                $currentDateTime = date('Y-m-d H:i:s');
                $PhuongThucThanhToan = 0;
                $TinhTrang = "Đang chờ xác nhận";
                $ThongTinThue = $lastName . ' ' . $firstName . ' ' . $address . ' ' . $city . ' ' . $phone;
                $GhiChu =   $email;
                // $MaKhachHang = $user->MaKhachHang;
                $MaKhachHang =  $fullName;
                $GiamGia = 0;
                $nv =$_SESSION['UserName'];
                $idEmployee = (new UserController())->getIdEmployee($nv);
                $user = (new UserController())->getIdCustomer($fullName);
                $sql = "INSERT INTO `hoadons` (`NgayTaoHoaDon`, `TongTien`, `GiamGia`, `PhuongThucThanhToan`, `TinhTrang`, `ThongTinThue`, `GhiChu`, `MaKhachHang`, `MaNhanVien`) 
                VALUES ('$currentDateTime', $totalPrice, $GiamGia , $PhuongThucThanhToan, '$TinhTrang', '$ThongTinThue', '$GhiChu', '$user->MaKhachHang', '$idEmployee->MaNhanVien')";
                $result = mysqli_query($conn,$sql);
                if ($result) {
                    $sql_max = "SELECT MAX(MaHoaDon) AS max_masp FROM hoadons";
                    $result_max = $conn->query($sql_max);
                    $row_max = $result_max->fetch_assoc();
                    $maxMaSP = $row_max['max_masp'];
                    // echo $maxMaSP;
                    $msg = 'Đặt hàng thành công';
                    if(isset($_SESSION['shopcart'])) {
                    $arrIds = array();
                    $totalPrices= 0;
                    foreach($_SESSION['shopcart'] as $id_sp =>$so_luong) {
                        $infoProductss = (new ProductController())->loadInfoProductById($id_sp);
                        foreach($infoProductss as $product) { 
                            require_once("../../Controller/ProductDetailController.php");
                            $productDetail = (new ProductDetailController())->getIdProductDetail($id_sp);
                           
                            $MaHoaDon =  $maxMaSP;
                            $MaChiTietSanPham  = $productDetail->MaChiTietSanPham;
                            $GiaBan = $productDetail->GiaBan;
                            $GiamGia = $productDetail->GiamGia;
                            $SoLuongBan = $_SESSION['shopcart'][$id_sp];
                            $GhiChu = 'Chưa Xác Nhận';
                            $sql = "INSERT INTO `chitiethoadons` (`MaHoaDon`, `MaChiTietSanPham`, `SoLuongBan`, `GiaBan`, `GiamGia`, `GhiChu`) 
                            VALUES ('$MaHoaDon', $MaChiTietSanPham, $SoLuongBan , $GiaBan, '$GiamGia', '$GhiChu')";
                            $results = mysqli_query($conn,$sql);
                            if($results) {
                                unset($_SESSION['shopcart']);
                            }
                        }          
                    }  
                } 
                } else {
                    $msg = 'Đặt hàng thất bại';
                }
            }
        }
    }
?>
<?php
	 
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
<section class="breadcrumb-section set-bg" style="background-color:#D21404">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center"><?php echo $msg ?></div>
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" required name="firstName">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" required name="lastName">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                        
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)" name="address" required>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" required name="city">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" required name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" required name="email">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <?php
                                        require_once("../../Controller/ProductController.php");
                                        if(isset($_SESSION['shopcart'])) {
                                            $arrId = array();
                                            $totalPrice= 0;
                                            foreach($_SESSION['shopcart'] as $id_sp =>$so_luong) {
                                                
                                                $infoProducts = (new ProductController())->loadInfoProductById($id_sp);
                                                foreach($infoProducts as $product) {
                                                    $totalPrice += $product->GiaNhoNhat * $_SESSION['shopcart'][$product->MaSP]; 
                                                    ?>
                                                    <li><?php echo $product->TenSpShort; ?>
                                                        <span> 
                                                            <?php 
                                                                $total = $product->GiaNhoNhat * $_SESSION['shopcart'][$product->MaSP];
                                                                echo getStringValue($total);
                                                            ?>
                                                        </span>
                                                    </li>
                                                    
                                                    <?php
                                                }          
                                            }  
                                        }  
                                    ?>
                                
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>
                                    <?php 
                                       if(isset($_SESSION['shopcart']))
                                       { 
                                         echo getStringValue($totalPrice);
                                       } else {
                                         echo "0";
                                       }
                                       ?>
                                    </span></div>
                                <div class="checkout__order__total">Total <span>
                                    <?php 
                                          if(isset($_SESSION['shopcart']))
                                          { 
                                            echo getStringValue($totalPrice);
                                          } else {
                                            echo "0";
                                          }
                                    ?>
                                    </span>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or" name="btncheck">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn" name="btnOrder" style="background-color:#D21404">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>