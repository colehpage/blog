
<?php
  include 'header.php';
?>



<div id="web-frame" class="inactive">

  <article class="article-body" style="padding-top: 100px;">
			<header class="article-header" style="text-align: center;">
				<div class="article-title">
					<h1>CONTACT FORM</h1>
				</div>
				<div class="article-title-metadata">
					<p>Last Updated Nov. 10, 2017</p>
				</div>
			</header>
			<main style="text-align: center; font-size: 18px">

        <form id="contact-form" style="width: 70%; margin-left: 15%;" action="./includes/contact.inc.php" method="POST">
          <div class="form-input-box">
            <input id="contact-name" class="form-input" type="text" name="name" placeholder="Full Name">
          </div>
          <div class="form-input-box">
            <input id="contact-email" class="form-input" type="text" name="email" placeholder="Email">
          </div>
          <select id="contact-gender" class="contact-select" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <textarea id="contact-message" class="contact-message" name="message" placeholder="Message..."></textarea>
          <button id="contact-submit" class="contact-button" type="submit" name="submit">Send Email</button>
          <p class="form-message"></p>

        </form>

			</main>
		</article>

</div>

<footer>

  <?php
    include 'footer.php';
  ?>

</footer>


<script>
  $(document).ready(function() {

    $('form').submit(function (event) {
      event.preventDefault();
      var name = $("#contact-name").val();
      var email = $("#contact-email").val();
      var gender = $("#contact-gender").val();
      var message = $("#contact-message").val();
      var submit = $("#contact-submit").val();
      $(".form-message").load("./includes/contact.inc.php", {
        name: name,
        email: email,
        gender: gender,
        message: message,
        submit: submit
      });
    });

  });
</script>

<script>
    $('.burger').click(function() {
        $(this).toggleClass('open');
    });

    $("#web-frame").addClass("inactive");
</script>

</body>

</html>
