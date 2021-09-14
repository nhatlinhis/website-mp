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
            <b>Thêm kho mới</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid row m-0">
    <div class="col-md-2"></div>
    <div class="card shadow mb-4 col-md-8 p-0">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">
                    Tạo kho hàng</h6>
            </div>
        </div>
        <div class="card-body">

            <form class="row" action="" method="POST">
                <div class="col-1"></div>
                <div class="col-5">
                    <div class="form-group">
                        <label for="Name"><strong>Tên kho hàng</strong></label>
                        <input type="text" id="Name" class="form-control Name" placeholder="Nhập tên kho hàng">
                        <div class="NameError invalid-feedback">
                            Chưa nhập tên kho hàng!!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Status"><strong>Trạng thái kho</strong></label>
                        <select class="form-control Status">
                            <option selected value="ACTIVE">ACTIVE</option>
                            <option value="DISABLE">DISABLE</option>
                        </select>
                    </div>
                </div>

                <div class="col-5">

                    <div class="form-group">
                        <label for="Address"><strong>Địa chỉ</strong></label>
                        <input type="text" id="Address" class="form-control Address" placeholder="Nhập địa chỉ">
                        <div class="AddressError invalid-feedback">
                            Chưa nhập địa chỉ!!
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="City"><strong>Tỉnh/ thành phố</strong></label>
                        <input type="text" id="City" class="form-control City" placeholder="Nhập tỉnh/ thành phố">
                        <div class="CityError invalid-feedback">
                            Chưa nhập tỉnh/ thành phố!!
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="Province"><strong>Quận/ huyện</strong></label>
                        <input type="text" id="Province" class="form-control Province" placeholder="Nhập quận/ huyện">
                        <div class="ProvinceError invalid-feedback">
                            Chưa nhập quận/ huyện!!
                        </div>
                    </div>

                    <button type="button" id="taokhohang" class="btn btn-primary">
                        Tạo kho hàng</button>
                </div>
            </form>



        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php include "../application/views/admin/_assets/footer.php" ?>
<script>
    $(document).ready(function() {
        loadPage("#warehousePage")
    })
</script>