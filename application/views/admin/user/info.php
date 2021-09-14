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
            <b>Thông tin khách hàng</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">Tất cả khách hàng</h6>
                <!-- Table Search -->
                <div class="col-md-6 d-flex justify-content-end form-inline find-input">
                    <input type="text" class="form-control find" 
                    placeholder="Tìm kiếm theo cột..." tb_id="user_table">

                    <select class="form-control ml-2">
                        <option selected value="1">Tên tài khoản</option>
                        <option value="2">Họ và tên</option>
                        <option value="3">Địa chỉ mail</option>
                        <option value="4">Số điện thoại</option>
                        <option value="5">Tỉnh/ thành phố</option>
                        <option value="7">Quận/ huyện</option>
                        <option value="8">Địa chỉ chi tiết</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <table id="user_table" class="display w-100">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên tài khoản</th>
                        <th>Họ và tên</th>
                        <th>Địa chỉ email</th>
                        <th>Số điện thoại</th>
                        <th>Tỉnh/ thành phố</th>
                        <th>Trạng thái</th>
                        <th>Quận/ huyện</th>
                        <th>Địa chỉ chi tiết: </th>
                        <th>Ngày tạo tài khoản: </th>
                        <th>Lần truy cập cuối: </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include "../application/views/admin/_assets/footer.php" ?>

<script>
    $(document).ready(function() {
        loadPage("#userPage")
        initTable("#user_table", "/admin/getAllUser")
    })
</script>