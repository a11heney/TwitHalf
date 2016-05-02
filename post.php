<?php

  function getHashtags($string) {
    $hashtags= FALSE;
    preg_match_all("/(#\w+)/u", $string, $matches);
    if ($matches) {
        $hashtagsArray = array_count_values($matches[0]);
        $hashtags = array_keys($hashtagsArray);
    }
    return $hashtags;
  }
  require("common.php");

  if(!empty($_POST))
  {
    if (isset($_GET['reply'])){
      $reply = $_GET['reply'];
    }
    else{
      $reply = "false";
    }
    $current_time = time();
    if (getHashtags($_POST['content']) == false){
      $hashtag_final = "none";
    }
    else{
      $hashtag_final = implode(",", $getHashtags($_POST['content']));
    }
    $query_params = array(
        ':author' => $_SESSION['user']['username'],
        ':content' => $_POST['content'],
        ':timestamp' => $current_time,
        ':reply' => $reply,
        ':hashtag' => $hashtag_final
    );

    $query = "
        INSERT INTO posts (
            author,
            content,
            timestamp,
            reply,
            hashtag
        ) VALUES (
            :author,
            :content,
            :timestamp,
            :reply,
            :hashtag
        )
    ";

    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex)
    {
        die("Failed to run query: " . $ex->getMessage());
    }

    header("Location: home.php");
    die("Redirecting to home.php");
  }

?>
