<?php
	require("common.php");
	if(empty($_SESSION['user'])){
		header("Location: index.php");
		die("Redirecting to index.php");
	}
  if (isset($_GET['username'])){
    $page_username = $_GET['username'];
  }
  else{
    header("Location: search.php");
    die("Redirecting to search.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="author" content="">
		<title><?php echo $page_username; ?> | The Buzz</title>
		<link href="favicon.ico" rel="icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
	</head>
	<body>
		<?php include_once ('navbar.php'); ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <img class="img-fluid img-thumbnail center-block" src="https://api.adorable.io/avatars/256/<?php echo $page_username ?>.png" alt="The drones bees are almost done their work!">
            <h1>@<?php echo $page_username; ?></h1>
						<div id="action-container"></div>
						<h3>Bio:</h3>
						<div id="bio-container"></div>
          </div>
          <div class="col-sm-8">
						<h4>Here's what they've been <b>buzzing about.</b></h4>
            <div id="feed-container">
          </div>
        </div>
			</div>
    </div>
    <?php include_once ('footer.php'); ?>
    <script src="js/jquery2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/buildPosts.js"></script>
		<script>
      var page_username = "<?php echo $_SESSION['user']['username']; ?>";
			$( document ).ready(function() {
					buildPosts("<?php echo $page_username; ?>", "all");
					$('.card').each(function() {
							$(this).html(linkHashtags($(this).html()));
							$(this).html(linkUsernames($(this).html()));
					});
			});
			var pageuser = "<?php echo $page_username; ?>";
			var infoData = JSON.parse(httpGet("info.php?user=" + pageuser));
			var userInfoData = JSON.parse(httpGet("info.php?user=" + page_username));
			$("#bio-container").html(infoData["bio"]);
			if (pageuser != page_username){
				if ($.inArray(pageuser, userInfoData['following'].split(",")) > -1 ){
					$("#action-container").html("<a class='btn btn-block btn-info-outline' href='follow.php?unfollow="+pageuser+"'><span class='fa fa-check'></span> Following " + pageuser + "</a>");
				}
				else{
					$("#action-container").html("<a class='btn btn-block btn-info-outline' href='follow.php?follow="+pageuser+"'><span class='fa fa-plus'></span> Follow " + pageuser + "</a>");
				}
			}
			else{
				$("#action-container").html("<a class='btn btn-block btn-info-outline' href='#'><span class='fa fa-edit'></span> Edit Bio</a>");
			}
		</script>
  </body>
</html>
