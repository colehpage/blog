<?php

if (isset($_POST['submit'])) {

	$name = $_POST["name"];
	$email = $_POST["email"];
	$gender = $_POST["gender"];
	$message = $_POST["message"];

	$errorEmpty = false;
	$errorEmail = false;

	if (empty($name) || empty($email) || empty($message)) {
		echo "<span class='form-error'>Fill in all fields!</span>";
		$errorEmpty = true;
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<span class='form-error'>Write a valid e-mail!</span>";
		$errorEmail = true;
	}
	else {
		echo "<span class='form-success'>E-mail has been sent!</span>";
	}

}

else {
	echo "Not working!";
}

?>

<script>
$("#contact-name, #contact-email, #contact-gender, #contact-message").removeClass( "input-error" )

	var errorEmpty = "<?php echo $errorEmpty; ?>";
	var errorEmail = "<?php echo $errorEmail; ?>";

	if (errorEmpty == true){
	    $("#contact-name, #contact-email, #contact-gender, #contact-message").addClass("input-error");
	}
	if (errorEmail == true){
	    $("#contact-email").addClass("input-error");
	}

	if (errorEmpty == false && errorEmail == false){
	    $("#contact-name, #contact-email, #contact-message").val('');
	}
</script>
