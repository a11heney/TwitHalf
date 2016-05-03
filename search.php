<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="author" content="">
		<title>Search | The Buzz</title>
		<link href="favicon.ico" rel="icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
	</head>
	<body>
		<?php include_once ('navbar.php'); ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
					<form>
						<div class="input-group">
							<input type="form" class="form-control" id="searchBar" placeholder="Search by @username or #hashtag">
							<div class="input-group-addon" onclick="search()"><span class="fa fa-search"></span></div>
						</div>
					</form>
					<ul class="nav nav-pills nav-stacked">
					  <li class="nav-item">
					    <a class="nav-link active" href="#"><span class="fa fa-list-alt"></span> Sort by All</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" onclick="swapSearchType('user');"><span class="fa fa-user"></span> Sort by User</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" onclick="swapSearchType('hashtag');"><span class="fa fa-hashtag"></span> Sort by Hashtag</a>
					  </li>
					</ul>
				</div>
				<div class="col-sm-9">
					<div id="feed-container">
						<h1 class="display-4">You haven't searched anything yet.</h1>
						<h3>You can search by @username or by #hashtag</h3>
					</div>
				</div>
      </div>
    </div>
    <?php include_once ('footer.php'); ?>
    <script src="js/jquery2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
		<script src="js/buildPosts.js"></script>
		<script>
			$( document ).ready(function() {
					buildPosts("all", "all");
					$('.card').each(function() {
						$(this).html(linkHashtags($(this).html()));
						$(this).html(linkUsernames($(this).html()));
					});
			});
			var searchType = "user";
			function swapSearchType(type){
				searchType = type;
			}
			function search(){
				var query = ('#searchBar').val();
				if (searchType == "user"){
					if (query.charAt(0) == "@"){
						query = query.substring(1);
					}
				}
				else if (searchType == "hashtag"){
					if (query.charAt(0) != "#"){
						query = "#" + query;
					}
				}
				console.log(query);
			}
		</script>
  </body>
</html>
