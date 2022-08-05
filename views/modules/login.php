<div id="back"></div>

<div class="login-box">

  <div class="login-logo">

    <img class="img-responsive" src="views/img/template/logo-blanco-bloque.png" style="padding: 30px 100px 0 100px">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">تکایە ناوی بەکارهێنەر و وشەی تێپەر داخل بکە</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="User" name="loginUser" required>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Password" name="loginPass" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">

        <div class="col-xs-6">

          <button style="font-family: NRT;" type="submit" class="btn btn-primary btn-block btn-flat">چوونە ژوورەوە</button>

        </div>
       
      </div>

      <?php

        $login = new ControllerUsers();
        $login -> ctrUserLogin();

      ?>

    </form>

  </div>

</div>
