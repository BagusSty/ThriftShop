<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">>
    <link rel="stylesheet" href="css/stylesheet.css" />
  </head>
  <body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
      <div class="card border-0 m-3 p-4 border-0">
        <!--Pesan gagal login-->
        <?php
        if(isset($_GET['pesan'])) {
          if($_GET['pesan']=="gagal") {
            echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
          }
        }
        ?>
        <div class="row d-flex p-5">
          <div class="col-lg-6">
            <img class="img img-fluid" src="assets/img/3255317.jpg" alt="" />
          </div>
          <div class="col-lg-6">
            <!--Form Login-->
            <form class="form form-group p-sm-5" action="proses_login.php" method="post">
              <div class="row px-3">
                <h2 class="title"><b>LOGIN</b></h2>
              </div>
              <div class="row px-3">
                <label for="username" class="mb-1 text-sm">Username </label>
                <input type="text" class="form-control mb-2" name="username" />
              </div>
              <div class="row px-3">
                <label for="password" class="mb-1 text-sm">Password </label>
                <input
                  type="password"
                  class="form-control mb-2"
                  name="password"
                />
              </div>
              <div class="row mt-4 justify-content-center">
                <button type="submit" name="submit" class="btn btn-primary">
                  <b>Login</b>
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="row px-3 text-center">
        <footer>
          <small class="ml-4 ml-sm-5 mb-2"
            >Copyright &copy; 2022. All rights reserved.</small
          >
        </footer>
      </div>
      </div>
    </div>
  </body>
</html>
