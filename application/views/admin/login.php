<html>

<head>
  <title>Watsons - Login admin</title>
  <?php require_once "../application/views/_shared/css.php"; ?>
  <style>
    .container-login {
      background: #009aa9;
    }
  </style>
</head>

<body>
  <div class="d-flex align-items-center container-login h-100">
    <div class="container container_s card pd-2 col-md-3">
      <form action="<?php echo BASEURL; ?>/admin/login" method="POST">
        <div class="col-12 col-md text-center">
          <a href="<?php echo BASEURL ?>">
            <img class="img-fluid pt-2" src="<?php echo BASEURL; ?>/public/assets/img/icon.jpg" alt="banner">
          </a>
          <small class="d-block mb-3 text-muted">IS207.L21</small>
        </div>
        <div class="form-group">
          <label for="Password">
            <i class="fa fa-key" aria-hidden="true"></i>
            <strong>Mật khẩu</strong>
          </label>
          <input type="password" id="Password" name="Password" class="form-control Password" placeholder="Nhập mật khẩu" required>
        </div>
        <?php
        if (isset($data['msg'])) {
          echo '<div class="alert alert-danger text-center" role="alert">';
          echo $data['msg'];
          echo '</div>';
        }
        ?>
        <div class="text-center">
          <button type="submit" class="btn btn-primary ">Đăng nhập</button>
        </div>
    </div>
    </form>
  </div>
  </div>
  </div>
  <footer class="fixed-bottom text-light">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © Watsons - Admin 2021</span>
      </div>
    </div>
  </footer>
  </div>
  </div>

  <?php require_once "../application/views/_shared/js.php"; ?>
  <script>
        $(document).ready(function () {
            $("#Password").keyup(function (e) {
                if (e.keyCode == 13) {
                    $("#login_admin").trigger('click')
                }
            })
        })
    </script>