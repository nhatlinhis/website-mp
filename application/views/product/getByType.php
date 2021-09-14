<html>

<head>
    <title>Watsons</title>
    <?php require_once "../application/views/_shared/css.php"; ?>
    <style>
        .bg-success {
            background-color: #009aa9!important;
        }
    </style>
</head>

<body>
    <?php include "../application/views/_shared/header.php" ?>
    <?php include "../application/views/_shared/nav.php" ?>

    <div class="container">
        <div class="card rounded-0 mt-3">
            <div class="card-header bg-success text-white rounded-0 d-flex">
                <h5 class="m-0"><?php echo $data[0]; ?></h5>
                <div class="dropdown ml-auto">
                    <button class="btn btn-outline-light dropdown-toggle pb-0 pt-0 pr-2 rounded-0" type="button"
                        data-toggle="dropdown">
                        Sắp xếp
                    </button>

                    <div class="dropdown-menu text-center rounded-0 bg-light">
                        <a class="dropdown-item sort" href="" onclick="sortProductASC()">Giá tăng dần</a>
                        <a class="dropdown-item sort" href="" onclick="sortProductDESC()">Giá giảm dần</a>
                    </div>
                </div>
            </div>
            <div class="card-body container">
                <div class="row row-cols-1 row-cols-sm-3 row-cols-md-5" id="bodyy">
                    <?php
                    if (count($data)) {
                        $i = 0;
                        foreach ($data as $val) {
                            if($i++ == 0) continue;
                            echo $val;
                        }
                    } else {
                        echo '<div class="alert alert-danger text-center mt-3">
                    <strong>Không có sản phẩm để hiển thị</strong></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "../application/views/_shared/footer.php" ?>
    <?php require_once "../application/views/_shared/js.php"; ?>
    <script>
        $(document).ready(function() {
            loadCategory()
            paging()
            loadImgAllProduct()
        })
    </script>
</body>

</html>