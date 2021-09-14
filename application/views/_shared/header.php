<style>
  header {
    background-color: #009aa9;
  }

  header a {
    font-size: 16px;
  }

  header a.p-2 i {
    color: #fff;
  }

  header a.p-2:hover {
    color: rgba(0,0,0,.7);
  }
</style>

<header>
  <div class="container d-flex">

    <a href="<?php echo BASEURL ?>" class="p-2">
    <i class="fas fa-home"></i> Trang chủ
  </a>

    <a class=" nav-link dropdown-toggle ml-auto p-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-user" aria-hidden="true"></i>
      <?php
      if ($this->getSession('Account'))
        echo "<strong class='account_user'>" . $this->getSession('Account') . "</strong>";
      else echo "Tài khoản"; ?>
    </a>

    <div class="dropdown-menu dropdown-menu-md-right">

      <?php
      if ($this->getSession('Account')) {
        echo '<a class="dropdown-item" href="' . BASEURL . "/user/profile" . '">';
        echo '<i class="far fa-id-card"></i>';
        echo '  Thông tin tài khoản';
        echo '</a>';
        echo '<div class="dropdown-divider"></div>';
        echo '<a class="dropdown-item" href="' . BASEURL . "/user/logout" . '">';
        echo '<i class="fas fa-sign-out-alt"></i> Đăng xuất</a>';
      } else {
        echo '<a class="dropdown-item" href="' . BASEURL . "/user/login" . '">';
        echo '<i class="fas fa-sign-in-alt"></i> Đăng nhập</a>';
      }
      ?>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo BASEURL . "/user/signup" ?>">
        <i class="fa fa-plus-square" aria-hidden="true"></i> Tạo tài khoản</a>
    </div>
  </div>


</header>