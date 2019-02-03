<?php
session_start();
if ($_SESSION['loggedin'] !== TRUE) {
  header('Location: ../landingpage/login.php');
}
if (isset($_POST['submit-search'])) {
  require "../init/config.php";
  require "../init/header.php";
  require "../init/sidebar.php";
  $kw = mysqli_real_escape_string($conn, $_POST['search']);
  $sql = "SELECT * FROM posts WHERE post_title LIKE '%$kw%' OR post_content LIKE '%$kw%'";
  $sql2 = "SELECT * FROM replies WHERE reply_content LIKE '%$kw%'";
  $result = mysqli_query($conn, $sql);
  $result2 = mysqli_query($conn, $sql2);
  $queryResult = mysqli_num_rows($result);
  $queryResult2 = mysqli_num_rows($result2);

  $printPosts = "";
  $printReplies = "";
  if ($queryResult > 0) { //Matchiningar för posts
    while ($rows = mysqli_fetch_assoc($result)) { // Fetch printable information from every row (post)
      $id = $rows['post_id'];
      $title = $rows['post_title'];
      $category = $rows['post_category'];
        $category_link = "../home/index.php?category=$category";
      $creator = $rows['post_creator'];
      $content = $rows['post_content'];
      $image = $rows['post_img'];
      $date = $rows['post_date'];
      $views = $rows['post_views'];
      $replies = $rows['post_replies'];
      //Section for calculating likes on each post and inserting it into post_likes
      $sqlLikes = "SELECT SUM(like_dislike) AS likes FROM likes WHERE post_id='$id' ";
      $resLikes = mysqli_query($conn, $sqlLikes);
      $rowLikes = mysqli_fetch_assoc($resLikes);
      $totLikes = $rowLikes['likes'];
      $sqlLikes2 = mysqli_query($conn, "UPDATE posts SET post_likes='$totLikes' WHERE post_id='$id' ");
      $likes = $totLikes;
      //Pushing HTML into the variable down here
      $printPosts .= "<div class = 'printed-post-frame'>";

        $printPosts .= "<a href='../posts/show-post.php?pid=$id' class='post-link'>";
          $printPosts .= "<div class='post-left'>";
            $printPosts .= "<h2 class='printed-post-title'> $title </h2>";
            $printPosts .= "<p class='printed-post-content'> $content </p>";
            if ($image != NULL) {
              $printPosts .= "<img src='../posts/uploads/$image' class='post_img' alt='bild till tråden' />";
            }
          $printPosts .= "</div>";
        $printPosts .= "</a>";

        $printPosts .= "<div class='post-right'>";
            /*$printPosts .= "<span class='upvote'></span>";*/
            /*$printPosts .= "<span class='downvote'></span>";*/
            $printPosts .= "<form action='../posts/like-parse.php?pid=$id' name='likeform' method='POST'>";
            $printPosts .= "<input class='upvote' type = 'text' value=$id name ='like'/>";
            $printPosts .=  "<span class='post_rating printed-post-likes'>$likes</span>";
            $printPosts .= "<input class='downvote' type = 'text' value=$id name ='dislike'/></form>";
        $printPosts .= "</div>";

        $printPosts .= "<div class='post-info'>";
          $printPosts .= "<a href='$category_link' class='links'> $category </a> <span class='divider'>/</span>";
          $printPosts .= "<span class='no_of_comments'> $replies </span><span class='comment_symbol'></span> <span class='divider'>/</span>";
          $printPosts .= "<span class='no_of_views'> $views </span><span class='view_symbol'></span> <span class='divider'>/</span>";
          $printPosts .= "<a class='links' href='../userpage/user.php?username=$creator' class='author'>$creator</a> <span class='divider'>/</span>";
          $printPosts .= "<span class='date_posted'>$date</span><span class='divider'>/</span>";

          if ($_SESSION['admin'] == 1) {
              $printPosts .= "<form class='deletepost_form' method='post' action='../posts/delete-posts.php?delete=$id' id='admin_deletepost'><input id='delete' type='submit' name='delete' value='ta bort'></input></form>";
          }
        $printPosts .= "</div>";

      $printPosts .= "</div>";
    }
  }//slutet av query 1
  if ($queryResult2 > 0) { //Matchingar för kommentarer
      while($rows2 = mysqli_fetch_assoc($result2)) {
        $pid = $rows2['post_id'];
        $rid = $rows2['reply_id'];
        $replyCreator = $rows2['reply_creator'];
        $replyContent = $rows2['reply_content'];
        $replyDate = $rows2['reply_date'];
        //Sum array of total likes on this comment
        $sqlLikes3 = "SELECT SUM(like_dislike) AS likes FROM likes WHERE reply_id='$rid' ";
        $resLikes2 = mysqli_query($conn, $sqlLikes3);
        $rowLikes2 = mysqli_fetch_assoc($resLikes2);
        $totLikes2 = $rowLikes2['likes'];
        $sqlLikes4 = mysqli_query($conn, "UPDATE replies SET reply_likes='$totLikes2' WHERE reply_id='$rid' ");
        $replyLikes = $totLikes2;

        $printReplies .= "<div class = 'printed-post-frame'>";
            $printReplies .= "<a href='../posts/show-post.php?pid=$pid' class='post-link'>";
            $printReplies .= "<div class='post-left'>";
              $printReplies .= "<p class='printed-post-content'> $replyContent </p>";
            $printReplies .= "</div>";

            $printReplies .= "<div class='post-right'>";
              $printReplies .= "<form action='like-parse.php?rid=$rid' name='likeform' method='POST'>";
              $printReplies .= "<input class='upvote' type = 'text' name ='like'/>";
              $printReplies .=  "<span class='post_rating printed-post-likes'>$replyLikes</span>";
              $printReplies .= "<input class='downvote' type = 'text' name ='dislike'/></form>";
            $printReplies .= "</div>";

        $printReplies .= "<div class='post-info'>";
          $printReplies .= "<a class='links' href='../userpage/user.php?username=$replyCreator' class='author'>$replyCreator</a> <span class='divider'>/</span>";
          $printReplies .= "<span class='date_posted'>$replyDate</span><span class='divider'>/</span>";


          if ($_SESSION['admin'] == 1) {
              $printReplies .= "<form class='delete-comment' method='post' action='../posts/delete-posts.php?rid=$rid' id='admin_deletepost'><input id='delete' type='submit' name='delete' value='Ta bort kommentar'></input></form>";
          }
        $printReplies .= "</div>";

       $printReplies .= "</div>";

      }
    }//Slutet av query2
}//Slutet av isset

 ?>
  <div id = "maincontent">
    <h1>Sökresultat - <?php echo $queryResult+$queryResult2; ?> träff(ar) på nyckelordet "<?php echo $kw; ?>"</h1>
    <h3>Trådar - <?php echo $queryResult;?> stycken:<?php echo $printPosts; ?></h3>
    <h3>Kommentarer - <?php echo $queryResult2;?> stycken: <?php echo $printReplies;?></h3>
  </div>
