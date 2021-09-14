<style>
  .img-banner {
    max-width: 25%;
    margin-top: 25px;
    margin-bottom: 25px;
  }

  nav .container {
    background-color: #009aa9;
  }

  .site-nav a,
  .navbar-light .navbar-brand,
  .navbar-light .navbar-nav .nav-link {
    color: #fff;
  }

  .btn-outline-secondary {
    color: #fff;
    border-color: #fff;
  }

  .site-nav a:hover {
    color: rgba(0, 0, 0, .7);
  }

  .navbar .dropdown-menu {
    background-color: #009aa9 !important;
  }

  @media (max-width: 740px) {
    .form-control {
      width: 89%;
    }

    .img-banner {
      max-width: 40%;
    }
  }

  @media (min-width: 576px) and (max-width:1023px) {
    .form-inline .form-control {
      width: 94%;
    }
  }
</style>

<div class="container-md text-center">
  <a href="<?php echo BASEURL ?>">
    <img class="img-fluid img-banner" src="<?php echo BASEURL; ?>/public/assets/img/logo.jpg" alt="banner">
  </a>
</div>


<!-- <nav class="navbar navbar-expand-md site-nav sticky-top"> -->
<nav class="navbar navbar-expand-lg navbar-light site-nav sticky-top">
  <div class="container pt-2 pb-2">
    <!-- <a class="navbar-brand pl-2 pr-4 border-right" href="<?php echo BASEURL ?>">
      <i class="fa fa-home" aria-hidden="true"></i> <strong>Trang chủ</strong>
    </a> -->

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" ari>
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- <div class="navbar-collapse"> -->
      <ul class="navbar-nav mr-auto">

        <li class="nav-item dropdown pl-2">
          <a class="nav-link" href="#" data-toggle="dropdown" id_ca='1'>Trang điểm
            <i class="fa fa-angle-down d-inline" aria-hidden="true"></i>
          </a>
        </li>

        <li class="nav-item dropdown pl-2">
          <a class="nav-link" href="#" data-toggle="dropdown" id_ca='2'>Chăm sóc da
            <i class="fa fa-angle-down d-inline" aria-hidden="true"></i>
          </a>
        </li>

        <li class="nav-item dropdown pl-2">
          <a class="nav-link" href="#" data-toggle="dropdown" id_ca='3'>Chăm sóc tóc
            <i class="fa fa-angle-down d-inline" aria-hidden="true"></i>
          </a>
        </li>

        <li class="nav-item dropdown pl-2">
          <a class="nav-link" href="#" data-toggle="dropdown" id_ca='4'>Nước hoa
            <i class="fa fa-angle-down d-inline" aria-hidden="true"></i>
          </a>
        </li>
      </ul>


      <div class="form-inline pl-2">
        <input class="form-control mr-1" id="sreach" type="text" placeholder="Nhập tên sản phẩm" aria-label="Tìm kiếm">
        <button id="sreach-product" class="btn btn-outline-secondary p-2" type="button">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>

      <a class="nav-link pl-2" href="<?php echo BASEURL; ?>/cart/info" aria-label="Giỏ hàng">
        <i class="fa fa-shopping-cart d-inline" aria-hidden="true"></i> Giỏ hàng
      </a>
    </div>
  </div>
</nav>