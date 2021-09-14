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
            <b>Thông tin kho hàng</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">
                    Tất cả kho hàng</h6>
                <!-- Table Search -->
                <div class="col-md-6 d-flex justify-content-end form-inline find-input">
                    <input type="text" class="form-control find" placeholder="Tìm kiếm theo cột..." tb_id="warehouse_table">

                    <select class="form-control ml-2">
                        <option selected value="1">Tên kho</option>
                        <option value="2">Họ và tên</option>
                        <option value="3">Tỉnh/ thành phố</option>
                        <option value="4">Quận/ huyện</option>
                        <option value="5">Địa chỉ chi tiết</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <table id="warehouse_table" class="display w-100">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên kho</th>
                        <th>Tỉnh/ thành phố</th>
                        <th>Quận/ huyện</th>
                        <th>Địa chỉ chi tiết</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Chi tiết</th>
                        <th>Ngày tạo kho</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal modify warehouse -->
<div class="modal fade" id="modify-warehouse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa thông tin kho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Name">
                        <i class="fas fa-file-signature"></i>
                        <strong>Tên kho</strong>
                    </label>
                    <input type="text" id="Name" name="Name" class="form-control Name" placeholder="Tên kho" required>
                </div>

                <div class="form-group">
                    <label for="city">
                        <i class="fas fa-city"></i>
                        <strong>Tỉnh/ thành phố</strong>
                    </label>
                    <input type="text" id="City" name="City" class="form-control City" placeholder="Tỉnh/ thành phố" required>
                </div>

                <div class="form-group">
                    <label for="Province">
                        <i class="fas fa-map-marked-alt"></i>
                        <strong>Huyện</strong>
                    </label>
                    <input type="text" id="Province" name="Province" class="form-control Province" placeholder="Huyện" required>
                </div>

                <div class="form-group">
                    <label for="Address">
                        <i class="fas fa-info-circle"></i>
                        <strong>Địa chỉ chi tiết</strong>
                    </label>
                    <input type="text" id="Address" name="Address" class="form-control Address" placeholder="Địa chỉ chi tiết" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button id="w-save" type="button" class="btn btn-success">Lưu thông tin</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal detail warehouse -->
<div class="modal fade" id="detail-warehouse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin chi tiết kho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <div class="row">
                            <h6 class="col-md-4 d-flex align-items-center font-weight-bold text-primary">
                                Chi tiết kho</h6>
                            <!-- Table Search -->
                            <div class="col-md-8 d-flex justify-content-end form-inline find-input">
                                <input type="text" class="form-control find" 
                                placeholder="Tìm kiếm theo cột..." tb_id="warehouse_detail_table">

                                <select class="form-control ml-2">
                                    <option selected value="1">Tên sản phẩm</option>
                                    <option value="2">Thương hiệu</option>
                                    <option value="3">Số lượng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="warehouse_detail_table" class="display w-100">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Thương hiệu</th>
                                    <th>Số lượng</th>
                                    <!-- <th>Ngày nhập mới</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
        loadPage("#warehousePage")
        initTable("#warehouse_table", "/admin/getAllWarehouse")
    })
</script>