<?php
session_start();
include '../dbh.php';

#check if login button has been pressed

if (isset($_POST['submit'])) {

  #Get values from form
  $uid = $_POST["uid"];
  $pwd = $_POST["pwd"];

  #VALIDATION

  #Start errors with false values
  #3 errors: empty fields, user does not exist, and incorect password
  $errorEmpty = false;
  $errorUsername = false;
  $errorPassword = false;

  #Querying database for username and checking password
  $sql = "SELECT * FROM user WHERE uid='$uid'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $hash_pwd = $row['pwd'];
  $hash = PASSWORD_VERIFY($pwd,$hash_pwd);

  #VALIDATION #1: Empty Fields
  if (empty($uid) || empty($pwd)) {
		echo "<span class='form-error'>Fill in all fields!</span>";
		$errorEmpty = true;
	}
  #VALIDATION #2: Username does not exist.
	elseif (!$row['uid']) {
		echo "<span class='form-error'>Username Does Not Exist!</span>";
		$errorUsername = true;
	}
  #VALIDATION #3: Incorrect Password.
  else {
    if($hash == 0) {
      echo "<span class='form-error'>Incorrect Password!</span>";
  		$errorPassword = true;
    }
    else {

      $sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$hash_pwd'";
      $result = mysqli_query($conn, $sql);

      if (!$row = mysqli_fetch_assoc($result)) {
        echo "<span class='form-error'>Incorrect Password!</span>";
        $errorPassword = true;
      }

      else {
        $_SESSION['id'] = $row['id'];
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['first'] = $row['first'];
        $_SESSION['last'] = $row['last'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['last_seen'] = $row['last_seen'];

        echo "<meta http-equiv='refresh' content='0'>";
      }

    }

	}

}

#Should never happen, just a backup
else {
	echo "Not Working Sorry!";
}

if(isset($_SESSION['uid'])){
    $session = 'true';
}else{
    $session = 'false';
}

?>


  <script>
    $("#login-username, #login-password").removeClass( "input-error" );

    	var errorEmpty = "<?php echo $errorEmpty; ?>";
    	var errorUsername = "<?php echo $errorUsername; ?>";
      var errorPassword = "<?php echo $errorPassword; ?>";


    	if (errorEmpty == true){
    	    $("#login-username, #login-password").addClass("input-error");
    	}
    	if (errorUsername == true){
    	    $("#login-username").addClass("input-error");
    	}
      if (errorPassword == true){
    	    $("#login-password").addClass("input-error");
    	}
    	if (errorEmpty == false && errorUsername == false && errorPassword == false){
    	    $("#login-username, #login-password").val('');
    	}


  </script>
