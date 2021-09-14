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
            <b>Thêm loại sản phẩm mới</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid row m-0">
    <div class="col-md-3"></div>
    <div class="card shadow mb-4 col-md-6 p-0">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">
                    Tạo loại sản phẩm</h6>
            </div>
        </div>
        <div class="card-body">

            <form class="row" action="" method="POST">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="Name"><strong>Tên loại sản phẩm</strong></label>
                        <input type="text" id="Name" class="form-control Name" placeholder="Nhập tên loại sản phẩm">
                        <div class="NameError invalid-feedback">
                            Chưa nhập tên loại sản phẩm!!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Status"><strong>Trạng thái loại sản phẩm</strong></label>
                        <select class="form-control Status">
                            <option selected value="ACTIVE">ACTIVE</option>
                            <option value="DISABLE">DISABLE</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Category"><strong>Danh mục</strong></label>
                        <select class="form-control Category">
                            <option selected value="1">Trang điểm</option>
                            <option value="2">Chăm sóc da</option>
                            <option value="3">Chăm sóc tóc</option>
                            <option value="4">Nước hoa</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                    <button type="button" id="taoloaisp" class="btn btn-primary">
                        Tạo loại sản phẩm</button>
                    </div>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php include "../application/views/admin/_assets/footer.php" ?>
<script>
    $(document).ready(function() {
        loadPage("#productPage")
    })
</script>