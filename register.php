<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--Boostrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/stylesheet.css" />
  <!-- Style CSS -->
  <style>
    @media (max-width: 768px) {
      .text {
        font-size:smaller;
    }
    img {
        display: none;
    }
    small {
        font-size:xx-small;
    }
}
</style>
</head>
<body>
  <div class="container-fluid px-xl-5 py-3 mx-auto">
    <div class="card border-0 m-3 p-3 border-0">
      <div class="row d-flex">
        <div class="col-lg-6">
          <img class="img img-fluid" src="assets/img/3255317.jpg" alt="" />
      </div>
      <div class="col-lg-6">
          <!--Form Register-->
          <form class="form form-group p-sm-5" action="proses_register.php" method="post">
            <div class="row px-3">
              <h2 class="title"><b>REGISTER</b></h2>
          </div>
          <div class="row px-3">
              <label for="nama" class="mb-1 text text-sm">Nama </label>
              <input type="text" class="form-control mb-2" autocomplete="off" name="nama" required/>
          </div>
          <div class="row px-3">
              <label for="username" class="mb-1 text text-sm">Username </label>
              <input type="text" class="form-control mb-2" autocomplete="off"  name="username" required/>
          </div>
          <div class="row px-3">
              <label for="no_hp" class="mb-1 text text-sm">No HP (08xxxxxxxxxx)</label>
              <input type="tel" class="form-control mb-2" autocomplete="off" name="no_hp" pattern="08[0-9]{10}" maxlength="15" required/>
          </div>
          <div class="row px-3">
              <label for="password" class="mb-1 text text-sm">Password </label>
              <input
              type="password" class="form-control mb-2" name="password" required/>
          </div>
          <div class="row pb-3 mt-4 justify-content-center">
              <button type="submit" name="submit" class="btn btn-primary">
                <b>Register</b>
            </button>
        </div>
    </form>
    <div class="row px-3">
        <p class="text"> Sudah memiliki akun?
          <a href="login.php">Login di sini</a>
      </p>
  </div>
</div>
</div>
<div class="row px-3 text-center">
    <footer>
      <small class="ml-sm-5 mb-2"
      >Copyright &copy; 2022. All rights reserved.</small
      >
  </footer>
</div>
</div>
</div>
</body>
</html>
