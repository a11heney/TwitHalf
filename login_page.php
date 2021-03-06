<?php
	require("common.php");
	if(!(empty($_SESSION['user']))){
		header("Location: home.php");
		die("Redirecting to home.php");
	}
	// gets action
  if (isset($_GET['register'])){
    $action = "registered";
  }
  else if (isset($_GET['failed'])){
    $action = "failed";
  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="author" content="">
		<title>Login | The Buzz</title>
		<link href="favicon.ico" rel="icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
	</head>
	<body>
		<?php include_once ('navbar.php'); ?>
    <div class="container">
      <div class="alert alert-dismissable fade" role="alert" id="reg-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span class="fa fa-close"></span>
         </button>
        <div id="reg-alert-content">
        </div>
      </div>
      <h2><span class="fa fa-sign-in"></span> Login</h2>
      <form action="login.php" method="post">
        <div class="row">
          <div class="col-sm-6">
            Email: <input type="text" class="form-control" name="email" value="" required=""/>
          </div>
          <div class="col-sm-6">
            Password: <input type="password" class="form-control" name="password" value="" required=""/>
          </div>
        </div>
        </br>
        <input class="btn btn-primary-outline" type="submit" value="Login" />
      </form>
			<h4>Don't have an account? <a href="index.php">Register Here.</a></h4>
    </div>
    <?php include_once ('footer.php'); ?>
    <script src="js/jquery2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
		// quick alert setter depending on what sent us here
      if ("<?php echo $action; ?>" == "registered"){
        $('#reg-alert').addClass("alert-info");
        $('#reg-alert').addClass("in");
        $('#reg-alert-content').html("Thanks for registering for <strong>The Buzz!</strong> Please login to confirm your registration.");
      }
      else if ("<?php echo $action; ?>" == "failed"){
        $('#reg-alert').addClass("alert-danger");
        $('#reg-alert').addClass("in");
        $('#reg-alert-content').html("Woops, sometimes honey makes it hard to type. Try entering your email and password again.");
      }
    </script>
  </body>
</html>
