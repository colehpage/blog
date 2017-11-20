<?php

session_start();

include '../dbh.php';
$uid = $_SESSION['uid'];
$sql = "UPDATE user SET last_seen = NOW() WHERE uid='$uid'";
$result = mysqli_query($conn, $sql);

session_destroy();


header("Location: ../index.php")
 ?>
