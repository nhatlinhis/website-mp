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
            <b>Thông tin loại sản phẩm</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">
                    Tất cả loại sản phẩm</h6>
                <!-- Table Search -->
                <div class="col-md-6 d-flex justify-content-end form-inline find-input">
                    <input type="text" class="form-control find" 
                    placeholder="Tìm kiếm theo cột..." tb_id="type_product_table">

                    <select class="form-control ml-2">
                        <option selected value="1">Tên loại sản phẩm</option>
                        <option value="2">Số lượng sản phẩm</option>
                        <option value="3">Danh mục</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <table id="type_product_table" class="display w-100">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
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

<!-- Modal modify type product -->
<div class="modal fade" id="modify-type-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa thông tin loại sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Name">
                        <i class="fas fa-file-signature"></i>
                        <strong>Tên loại sản phẩm</strong>
                    </label>
                    <input type="text" id="Name" name="Name" class="form-control Name" placeholder="Tên kho" required>
                </div>

                <div class="form-group">
                    <label for="Category"><strong>Danh mục</strong></label>
                    <select class="form-control Category" name="Category">
                        <option selected value="1">Trang điểm</option>
                        <option value="2">Chăm sóc da</option>
                        <option value="3">Chăm sóc tóc</option>
                        <option value="4">Nước hoa</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                <button id="tp-save" type="button" class="btn btn-success">Lưu thông tin</button>
            </div>
        </div>
    </div>
</div>

<?php include "../application/views/admin/_assets/footer.php" ?>
<script>
    $(document).ready(function() {
        loadPage("#productPage")
        initTable("#type_product_table", "/admin/getAllTypeProduct")
    })
</script>