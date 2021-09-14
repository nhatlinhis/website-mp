<html>

<head>
    <title>Cart info</title>
    <?php require_once "../application/views/_shared/css.php"; ?>
</head>

<body>
    <?php include "../application/views/_shared/header.php" ?>
    <?php include "../application/views/_shared/nav.php" ?>
    <div class="container mt-3">
        <div class="row" id="content">
            <div class="col-md-8" id="body_cart">
                <div class="row mt-1">
                    <div class="col-lg-6 col-md-6">
                        <strong>Giỏ hàng (<span id="quantity_sp"></span> sản phẩm)</strong>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <h6 class="text-secondary"> Giá mua</h6>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <h6 class="text-secondary"> Số lượng</h6>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <h6 class="text-secondary"> Thành tiền</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="border p-2">
                    <p class="d-flex" id="priceTotal">
                        <b class="mr-auto">Tạm tính: </b>
                        <i class="text-success"><span id="tamtinh_c" tien=""></span>₫</i>
                    </p>
                    <hr>
                    <p class="d-flex">
                        <span class="mr-auto">Thành tiền: </span>
                        <b class="text-danger"><span id="thanhtien_c" tien=""></span>₫</b>
                    </p>
                    <p class="text-right text-secondary">
                        <i><small>(Chưa bao gồm phí vận chuyển)</small></i>
                    </p>
                </div>
                <a id="btn_submit_cart" type="button" class="btn btn-success w-100 mt-3" href="<?php echo BASEURL?>/order/info"> 
                    TIẾN HÀNH ĐẶT HÀNG 
                </a>
            </div>

        </div>
    </div>
    </div>
    <?php include "../application/views/_shared/footer.php" ?>
    <?php require_once "../application/views/_shared/js.php"; ?>
    <script>
        $(document).ready(function() {
            loadCategory()
            loadCart('<?php echo $this->getSession('Account') ?>')
        })
    </script>
</body>

</html>