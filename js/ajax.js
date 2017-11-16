/*
 * Login User
 */
$(".sign-in-button").click(function(e) {
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();

    if (email != "" && password != "") {

        $("login_msg").html("<i class='fa fa-spinner fa-spin fa-lg text-success' style='font-size:20px'></i>");

        $.ajax({
            type: 'POST',
            url: "login.php",
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if (response == "true") {
                    $(".login-modal").html("<span class='alert alert-success'>Login successful! Redirecting...</span>");
                    window.location.href = "loggedin.php";
                } else {
                    $("#login_msg").html('Sorry, your registration was not successful. Please check your details and try again: ');
                    console.log(response)
                }

            }
        });

    }
});
