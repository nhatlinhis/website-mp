<html>

<head>
  <title>Đăng nhập</title>
  <?php require_once "../application/views/_shared/css.php"; ?>
  <style>
    .img-banner {
      max-width: 25%;
      margin-top: 25px;
      margin-bottom: 25px;
    }

    @media (max-width: 740px) {
      .img-banner {
        max-width: 50%;
      }
    }
  </style>
</head>

<body>
  <?php include "../application/views/_shared/header.php" ?>

  <?php
  if (isset($data['msg'])) {
    echo '<div class="alert alert-success text-center" role="alert">';
    echo $data['msg'];
    echo '</div>';
  }
  ?>

  <!-- <div class="d-flex align-items-center">
    <div class="container container_s card mt-3 pt-4 col-3">
      <form class="row" action="" method="POST">
          <div class="col-12">
            <div class="form-group">
              <label for="Account"><strong>Tên tài khoản</strong></label>
              <input type="text" id="Account" class="form-control Account" placeholder="Nhập tên tài khoản">
              <div class="AccountError invalid-feedback">
                Chưa nhập tên tài khoản!!
              </div>
            </div>


            <div class="form-group">
              <label for="Password"><strong>Mật khẩu</strong></label>
              <input type="password" id="Password" class="form-control Password" placeholder="Nhập mật khẩu">
              <div class="PasswordError invalid-feedback">
                Chưa nhập mật khẩu!!
              </div>
            </div>
            <p class="text-center">Không phải là thành viên? <a href="<?php echo BASEURL ?>/user/signup">Đăng ký</a></p>
            <div class="text-center">
              <button type="button" id="login" class="btn btn-primary ">Đăng nhập</button>
            </div>
          </div>
        </form>
    </div>
  </div> -->
  <div class="container-md text-center">
    <a href="<?php echo BASEURL ?>">
      <img class="img-fluid img-banner" src="<?php echo BASEURL; ?>/public/assets/img/logo.jpg" alt="banner">
    </a>
  </div>

  <div class="d-flex justify-content-center">
    <form class="px-4 py-3" action="" method="POST">
      <div class="form-group">
        <label for="Account"><strong>Tên tài khoản</strong></label>
        <input type="text" id="Account" class="form-control Account" placeholder="Nhập tên tài khoản">
        <div class="AccountError invalid-feedback">
          Chưa nhập tên tài khoản!!
        </div>
      </div>


      <div class="form-group">
        <label for="Password"><strong>Mật khẩu</strong></label>
        <input type="password" id="Password" class="form-control Password" placeholder="Nhập mật khẩu">
        <div class="PasswordError invalid-feedback">
          Chưa nhập mật khẩu!!
        </div>
      </div>
      <p class="text-center">Không phải là thành viên? <a href="<?php echo BASEURL ?>/user/signup">Đăng ký</a></p>
      <div class="text-center">
        <button type="button" id="login" class="btn btn-primary ">Đăng nhập</button>
      </div>
    </form>
  </div>


  <?php include "../application/views/_shared/footer.php" ?>
  <?php require_once "../application/views/_shared/js.php"; ?>
  <script>
    $(document).ready(function() {
      $("#Password").keyup(function(e) {
        if (e.keyCode == 13) {
          $("#login").trigger('click')
        }
      })
    })
  </script>
</body>

</html>