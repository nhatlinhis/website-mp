<?php include "../application/views/admin/_assets/header.php" ?>
<!-- Topbar -->
<div class="container-fluid bg-white mb-4 text-center shadow">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Topbar info -->
        <div class="sidebar-heading text-warning text-lg">
            <b>Thông tin các sản phẩm</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">
                    Tất cả sản phẩm</h6>
                <!-- Table Search -->
                <div class="col-md-6 d-flex justify-content-end form-inline find-input">
                    <input type="text" class="form-control find" placeholder="Tìm kiếm theo cột..." tb_id="product_table">

                    <select class="form-control ml-2">
                        <option selected value="1">Tên sản phẩm</option>
                        <option value="3">Thương hiệu</option>
                        <option value="2">Loại sản phẩm</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <table id="product_table" class="display w-100">
                <thead>
                    <tr>
                        <!-- id, name, brand, color, price, img, short_dis, dis, type_name, quantity, date_created, date_modify -->
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Màu</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Mô tả ngắn</th>
                        <th>Mô tả chi tiết</th>
                        <!-- <th>Hình</th> -->
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal modify product -->
<div class="modal fade" id="modify-product" id_p="" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa thông tin sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Name">
                                <i class="fas fa-file-signature"></i>
                                <strong>Tên sản phẩm</strong>
                            </label>
                            <input type="text" id="Name" name="Name" class="form-control Name" 
                            placeholder="Tên sản phẩm" required>
                            <div class="NameError invalid-feedback">
                                Chưa nhập tên sản phẩm!!
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Brand">
                                <i class="fas fa-city"></i>
                                <strong>Thương hiệu</strong>
                            </label>
                            <input type="text" id="Brand" name="Brand" class="form-control Brand" 
                            placeholder="Thương hiệu" required>
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
                            <input type="number" id="Price" name="Price" class="form-control Price" 
                            placeholder="Giá" required>
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
                                <input type="number" id="Quantity" name="Quantity" class="form-control Quantity" 
                                    placeholder="Số lượng" required>
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
                            <input type="text" id="Short-Description" name="Short-Description" 
                            class="form-control Short-Description" placeholder="Mô tả ngắn" required>
                            <div class="Short-DescriptionError invalid-feedback">
                                Chưa nhập mô tả ngắn!!
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Description">
                                <i class="fas fa-info-circle"></i>
                                <strong>Mô tả</strong>
                            </label>
                            <textarea class="form-control" rows="4" id="Description" name="Description" 
                            required></textarea>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button id="p-save" type="button" class="btn btn-success">Lưu thông tin</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal detail product -->
<div class="modal fade" id="detail-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin chi tiết sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>
<?php include "../application/views/admin/_assets/footer.php" ?>
<script>
    $(document).ready(function() {
        loadPage("#productPage")
        initTable("#product_table", "/admin/getAllProduct")
    })
</script>