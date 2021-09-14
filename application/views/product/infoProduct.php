<html>

<head>
    <title>Watsons</title>
    <?php require_once "../application/views/_shared/css.php"; ?>
</head>

<body>
    <?php include "../application/views/_shared/header.php" ?>
    <?php include "../application/views/_shared/nav.php" ?>

    <div class="container mt-3" >
        <div class="row" id_p="<?php echo $data[0]->id?>">
            <div class="col-md-5">
                <img class="border img-fluid" src='<?php echo $data[0]->img?>'>
            </div>

            <div class="col-md-5">
                <p class="text-secondary m-1"><?php echo $data[0]->name?></p>
                <p class="price-product m-1"><?php echo $this->formatPrice($data[0]->price)?> ₫</p>
                <p class="m-1">Thương hiệu: <span><?php echo $data[0]->brand?></span></p>
                <?php 
                    if($data[0]->color != "#000000"){
                        echo '<p class="m-1 form form-inline"> Màu: ';
                        echo '<span><input disabled type="color" class="p-color ml-2" value="'
                            .$data[0]->color.'"></span></p>';
                    }
                ?>
                <hr>
                <p class="text-secondary m-1"><?php echo $data[0]->short_discription?></p>
                <hr>
                <div class="form form-inline">
                    <input class="form-control quantity mr-3" type="number" min="1" value="1" 
                            max="<?php echo $data[0]->quantity?>">
                    <button class="btn btn-success addToCart">
                    <i class="fa fa-shopping-cart d-inline" aria-hidden="true"></i>
                    Thêm vào giỏ
                    </button>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <div class="info border mt-3">
            <div class="head-info p-2">
                Thông tin sản phẩm
            </div>
            <div class="body-info p-2">
            <?php echo $data[0]->discription?>
            </div>
        </div>
    </div>
    <?php include "../application/views/_shared/footer.php" ?>
    <?php require_once "../application/views/_shared/js.php"; ?>
    <!-- <script src="<?php echo BASEURL ?>/public/assets/js/product.js"></script> -->
    <script>
        $(document).ready(function() {
            loadCategory()
        })
    </script>
</body>

</html>