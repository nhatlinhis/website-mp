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
            <b>Thông tin đơn đặt hàng bị hủy</b>
        </div>
    </nav>
</div>
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

<div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <h6 class="col-md-6 d-flex align-items-center font-weight-bold text-primary">Tất cả đơn hàng bị hủy</h6>
                <!-- Table Search -->
                <div class="col-md-6 d-flex justify-content-end form-inline find-input">
                    <input type="text" class="form-control find" 
                    placeholder="Tìm kiếm theo cột..." tb_id="order_cancel_table">

                    <select class="form-control ml-2">
                        <option selected value="6">Tên tài khoản</option>
                        <option value="1">Tên khách hàng</option>
                        <option value="2">Số điện thoại</option>
                        <option value="4">Tổng tiền</option>
                        <option value="7">Địa chỉ</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <table id="order_cancel_table" class="display w-100">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Phí vận chuyển</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết hóa đơn</th>
                        <th>Tên tài khoản</th>
                        <th>Địa chỉ: </th>
                        <th>Ngày đặt hàng: </th>
                        <th>Ngày cập nhật đơn hàng: </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->



<!-- detail order cancel -->
<div class="modal fade" id="detail-order" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin hóa đơn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id_o="">
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="Name">
                        <i class="fas fa-file-signature"></i>
                        <strong>Tên khách hàng</strong>
                    </label>
                    <input type="text" id="Name" name="Name" class="form-control Name" placeholder="Tên khách hàng" disabled>
                </div>

                <div class="form-group">
                    <label for="Phone">
                        <i class="fas fa-phone"></i>
                        <strong>Số điện thoại</strong>
                    </label>
                    <input type="text" id="Phone" name="Phone" class="form-control Phone" disabled>
                </div>

                <div class="form-group">
                    <label for="Shipping-fee">
                        <i class="fas fa-dollar-sign"></i>
                        <strong>Phí vận chuyển</strong>
                    </label>
                    <input type="number" id="shipping-fee" name="Shipping-fee" class="form-control Shipping-fee" disabled>
                </div>

                <div class="form-group">
                    <label for="city">
                        <i class="fas fa-city"></i>
                        <strong>Tỉnh/ thành phố</strong>
                    </label>
                    <input type="text" id="City" name="City" class="form-control City" placeholder="Tỉnh/ thành phố" disabled>
                </div>

                <div class="form-group">
                    <label for="Province">
                        <i class="fas fa-map-marked-alt"></i>
                        <strong>Huyện</strong>
                    </label>
                    <input type="text" id="Province" name="Province" class="form-control Province" placeholder="Huyện" disabled>
                </div>

                <div class="form-group">
                    <label for="Address">
                        <i class="fas fa-info-circle"></i>
                        <strong>Địa chỉ chi tiết</strong>
                    </label>
                    <input type="text" id="Address" name="Address" class="form-control Address" placeholder="Địa chỉ chi tiết" disabled>
                </div>
                </div>

                <div class="col-md-6 order-detail">
                    
                </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>
<!-- ./end detail order cancel -->
<?php include "../application/views/admin/_assets/footer.php" ?>

<script>
    $(document).ready(function() {
        loadPage("#orderPage")
        initTable("#order_cancel_table", "/admin/getAllOrderCancel")
    })
</script>