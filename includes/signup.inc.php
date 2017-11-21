<?php
session_start();
include '../dbh.php';

#check if signup button has been pressed

if(isset($_POST['submit'])) {

  #grab values from form
  $first = $_POST['first'];
  $last = $_POST['last'];
  $email = $_POST['email'];
  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  #VALIDATION

  #Start errors with false values
  #4 Errors: Empty, Username taken, not valid email address, email taken
  #Eventually password match and password strength/complexity will be added to validation
  $errorEmpty = false;
  $errorUsername = false;
  $errorEmail = false;
  $errorEmailTaken = false;

  $sql = "SELECT uid FROM user WHERE uid='$uid'";
  $result = mysqli_query($conn, $sql);
  $uidcheck = mysqli_num_rows($result);

  $sql = "SELECT email FROM user WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $emailcheck = mysqli_num_rows($result);


  #Error 1: Empty fields
  if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
		echo "<span class='form-error'>Fill in all fields!</span>";
		$errorEmpty = true;
	}

  #Error 2: Username Already Taken
  #Querying database for username

  elseif ($uidcheck > 0) {
    echo "<span class='form-error'>Username Is Already Taken!</span>";
    $errorUsername = true;
  }



  else {

    #Error 3: Valid Email Address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<span class='form-error'>Write a valid e-mail!</span>";
      $errorEmail = true;
    }

    #Error 4: Email Address is Taken
    elseif ($emailcheck > 0) {
      echo "<span class='form-error'>Email Is Already Taken!</span>";
      $errorEmailTaken = true;
    }

    else {

      $encrypted_password = password_hash($pwd, PASSWORD_DEFAULT);
      $sql = "INSERT INTO user (first, last, email, uid, pwd, created, last_seen)
      VALUES ('$first', '$last', '$email', '$uid', '$encrypted_password', NOW(), NOW())";
      $result = mysqli_query($conn, $sql);
      echo "<meta http-equiv='refresh' content='0'>";

    }

  }

}

else {
	echo "Not working!";
}

?>

<script>
	$("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").removeClass( "input-error" )

	var errorEmpty = "<?php echo $errorEmpty; ?>";
  var errorUsername = "<?php echo $errorUsername; ?>";
  var errorEmail = "<?php echo $errorEmail; ?>";
	var errorEmailTaken = "<?php echo $errorEmailTaken; ?>";

	if (errorEmpty == true){
	    $("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").addClass("input-error");
	}
  if (errorUsername == true){
	    $("#signup-username").addClass("input-error");
	}
	if (errorEmail == true){
	    $("#signup-email").addClass("input-error");
	}
  if (errorEmailTaken == true){
      $("#signup-email").addClass("input-error");
  }

	if (errorEmpty == false && errorUsername == false && errorEmail == false && errorEmailTaken == false){
	    $("#signup-first, #signup-last, #signup-email, #signup-username, #signup-password").val('');
	}
</script>
