<html>

<head>
    <title>Order info</title>
    <?php require_once "../application/views/_shared/css.php"; ?>
</head>

<body>
    <?php include "../application/views/_shared/header.php" ?>
    <?php include "../application/views/_shared/nav.php" ?>
    <div class="container mt-3">
        <div class="row" id="content">
            <div class="col-lg-6">
                <h3 class="h4 text-secondary">Địa chỉ nhận hàng</h3>
                <div id="info-order">
                    <div class="form-group">
                        <label for="FullName" class="ml-2"><strong>Họ và tên</strong></label>
                        <input type="text" id="FullName" class="form-control FullName" placeholder="Nhập họ và tên">
                        <div class="FullNameError invalid-feedback">
                            Chưa nhập họ và tên!!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Phone" class="ml-2"><strong>Số điện thoại</strong></label>
                        <input type="number" id="Phone" class="form-control Phone" placeholder="Nhập số điện thoại">
                        <div class="PhoneError invalid-feedback">
                            Chưa nhập số điện thoại!!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Address" class="ml-2"><strong>Địa chỉ</strong></label>
                        <input type="text" id="Address" class="form-control Address" placeholder="Nhập địa chỉ">
                        <div class="AddressError invalid-feedback">
                            Chưa nhập địa chỉ!!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="City" class="ml-2"><strong>Tỉnh/ thành phố</strong></label>
                        <input type="text" id="City" class="form-control City" placeholder="Nhập tỉnh/ thành phố">
                        <div class="CityError invalid-feedback">
                            Chưa nhập tỉnh/ thành phố!!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Province" class="ml-2"><strong>Quận/ huyện</strong></label>
                        <input type="text" id="Province" class="form-control Province" placeholder="Nhập quận/ huyện">
                        <div class="ProvinceError invalid-feedback">
                            Chưa nhập thành quận/ huyện!!
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 col-8">
                            <a class="btn btn-secondary" href="<?php echo BASEURL ?>/cart/info">QUAY LẠI GIỎ HÀNG</a>
                        </div>
                        <div class="col-sm-6 col-4">
                            <button class="btn btn-success" type="button" id="btn-tt">THANH TOÁN</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">

                <div class="card shadow">
                    <h4 class="card-header p-2 pl-4">Giỏ Hàng</h4>
                    <div class="card-body pb-0" id="info-cart">
                    </div>

                    <div class="pl-4 pr-3">
                        <p class="d-flex" id="priceTotal">
                            <span class="mr-auto">Tạm tính: </span>
                            <i class="text-success"><span id="tamtinh_c" tien=""></span>₫</i>
                        </p>
                        <p class="d-flex" id="priceTotal">
                            <span class="mr-auto">Phí vận chuyển: </span>
                            <i class="text-success"><span>20,000</span>₫</i>
                        </p>
                        <hr>
                        <p class="d-flex">
                            <b class="mr-auto">Thành tiền: </b>
                            <b class="text-danger"><span id="thanhtien_c" tien=""></span>₫</b>
                        </p>
                        <p class="text-right text-secondary">
                            <i><small>* Phương thức thanh toán: Nhận hàng & thanh toán tiền mặt tại nhà</small></i>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <?php include "../application/views/_shared/footer.php" ?>
        <?php require_once "../application/views/_shared/js.php"; ?>
        <script>
            $(document).ready(function() {
                loadCategory()
                loadOrder('<?php echo $this->getSession('Account') ?>')
                <?php
                if ($this->getSession('Account')) {
                    echo "loadAddress()";
                }
                ?>
            })
        </script>
</body>

</html>