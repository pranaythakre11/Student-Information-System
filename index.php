<?php
  require_once("config.php");

  // Check Session 
if(isset($_SESSION['email']))
{
    header("location:home.php");
}

  if(!empty($_POST))
  {
    // Get Form Data
    $email = $_POST['email'];
    $pass = sha1($_POST['pass']);

    // Secured Data
    $securedEmail = mysqli_real_escape_string($auth,$email);
    $securedPass = mysqli_real_escape_string($auth,$pass);

    $sql = mysqli_query($auth,"SELECT email,password FROM students WHERE email = '$securedEmail' AND password = '$securedPass'");
    if(mysqli_num_rows($sql) == 1)
    {
      // Login Success
      $_SESSION['email'] = $securedEmail; // Session Set
      header("location:home.php"); // Redirect to Private Page
    }
    else
    {
      // Login Failed
      $status = "0";
    }

  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login | Student Information System</title>
  </head>
  <body>
    <?php 
        include_once("include/navbar.php");
        include_once("include/slider.php");
    ?>
<div class="container">
        <h1 class="display-4 border-bottom">Login</h1>

        <?php
        if ($status == "0") { ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Incorrect credentials.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        ?>
        <form method="post" action="">
            <div class="row row-cols-md-2 row-cols-1 py-4">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password" required>
                        <label for="pass">Password</label>
                    </div>
                </div>
                <div class="col">
                    <input type="submit" value="Login" class="btn btn-dark">
                </div>
            </div>
        </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>