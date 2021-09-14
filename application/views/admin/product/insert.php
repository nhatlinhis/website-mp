<?php include "../application/views/admin/_assets/header.php" ?>
<!-- Topbar -->
<div class="container-fluid bg-white mb-4 text-center shadow" id="admin-navbar">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Topbar info -->
        <div class="sidebar-heading text-warning text-lg">
            <b>Thêm sản phẩm mới</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid row m-0">
    <div class="col-md-1"></div>
    <div class="card shadow mb-4 col-md-10 p-0">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">
                    Tạo sản phẩm</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="mr-md-4 ml-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">
                                <i class="fas fa-file-signature"></i>
                                <strong>Tên sản phẩm</strong>
                            </label>
                            <input type="text" id="Name" name="Name" class="form-control Name" placeholder="Tên sản phẩm" required>
                            <div class="NameError invalid-feedback">
                                Chưa nhập tên sản phẩm!!
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Brand">
                                <i class="fas fa-city"></i>
                                <strong>Thương hiệu</strong>
                            </label>
                            <input type="text" id="Brand" name="Brand" class="form-control Brand" placeholder="Thương hiệu" required>
                            <div class="BrandError invalid-feedback">
                                Chưa nhập tên thương hiệu!!
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Color">
                                <i class="fas fa-map-marked-alt"></i>
                                <strong>Màu</strong>
                            </label>
                            <input type="color" id="Color" name="Color" class="form-control Color" value="#000000">
                        </div>

                        <div class="form-group">
                            <label for="Price">
                                <i class="fas fa-info-circle"></i>
                                <strong>Giá bán</strong>
                            </label>
                            <input type="number" id="Price" name="Price" class="form-control Price" placeholder="Giá" required>
                            <div class="PriceError invalid-feedback">
                                Chưa nhập giá sản phẩm!!
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label for="Price" class="mr-md-2">
                                <i class="fas fa-info-circle"></i>
                                <strong>Ảnh sản phẩm</strong>
                            </label>
                            <div class="hovereffect">
                                <img id="img-product" width="150px" src="<?php echo BASEURL?>/public/assets/img/product.png">
                                <div class="overlay">
                                    <label for="Img" class="info">Chọn file ảnh</label>
                                    <input id="Img" type="file" class="form-control Img" name="Img" accept="image/*" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Type-product"><strong>Loại sản phẩm</strong></label>
                            <select class="form-control Type-product" name="Type-product">

                            </select>
                        </div>

                        <div class="form-row form-group">
                            <div class="col-md-6 Warehouse">
                                <label for="Warehouse"><strong>Kho</strong></label>
                                <select class="form-control Warehouse" id="Warehouse" name="Warehouse">

                                </select>
                            </div>
                            <div class="col-md-4 Quantity">
                                <label for="Quantity"><strong>Số lượng</strong></label>
                                <input type="number" id="Quantity" name="Quantity" class="form-control Quantity" placeholder="Số lượng" required>
                                <div class="QuantityError invalid-feedback">
                                    Chưa nhập số lượng!!
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="AddWarehouse btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Short-Description">
                                <i class="fas fa-info-circle"></i>
                                <strong>Mô tả ngắn</strong>
                            </label>
                            <input type="text" id="Short-Description" name="Short-Description" class="form-control Short-Description" placeholder="Mô tả ngắn" required>
                            <div class="Short-DescriptionError invalid-feedback">
                                Chưa nhập mô tả ngắn!!
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Description">
                                <i class="fas fa-info-circle"></i>
                                <strong>Mô tả</strong>
                            </label>
                            <textarea class="form-control" rows="4" id="Description" name="Description" required></textarea>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button id="p-insert" type="button" class="btn btn-primary">Lưu thông tin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php include "../application/views/admin/_assets/footer.php" ?>
<script>
    $(document).ready(function() {
        loadPage("#productPage")
        loadInsertP();
    })
</script>