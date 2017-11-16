<?php

function setComments($conn) {
  if(isset($_POST['commentSubmit'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);


    $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
    $result = mysqli_query($conn, $sql);

  }
}

function getComments($conn) {
  $sql = "SELECT * FROM comments";
  $result = mysqli_query($conn, $sql);

  echo "<div class='comments-wrapper'>";
  while(  $row = mysqli_fetch_assoc($result)) {
    //BAD FORM TO USE THESE FOLLOWING VARIABLE NAMES
    //ALSO UNNECESSARY SINCE I HAVE UID SAVED IN SESSION VARIABLE, BUT STILL DOING FOR PRACTICE
    $id = $row['uid'];
    $sql2 = "SELECT * FROM user WHERE uid='$id'";
    $result2 = mysqli_query($conn, $sql2);
    if( $row2 = mysqli_fetch_assoc($result2)) {
      echo "<div class='comment-box'><p>";
      echo $row2['uid']."<br>";
      echo $row['date']."<br><br>";
      echo nl2br($row['message']);
      echo "</p>";
      if(isset($_SESSION['id'])) {
        if($_SESSION['id'] == $row2['id']) {
          $id = $_SESSION['id'];
          echo "
            <form class='delete-form' method='POST' action='".deleteComments($conn, $id)."'>
              <input type='hidden' name='cid' value='".$row['cid']."'>
              <button class='comment-delete' type='submit' name='commentDelete'>Delete Post</button>
            </form>";
        } else {
          echo "
            <form style='display: none;' class='reply-form' method='POST' action=''>
              <input type='hidden' name='cid' value='".$row['cid']."'>
              <button class='comment-reply' type='submit' name='commentDelete'>Reply</button>
            </form>";
        }
      }
      echo "</div>";
    }
  }
  echo "</div>";


}


function deleteComments($conn, $id) {
  if(isset($_POST['commentDelete'])) {
    $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid='$cid' AND $uid='$id'";
    $result = mysqli_query($conn, $sql);
    header("Location: ./whiteboard.php");

  }
}


?>
