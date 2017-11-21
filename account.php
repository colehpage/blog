
<?php
  include 'header.php';
?>



<div id="web-frame" class="inactive">

  <article class="article-body" style="padding-top: 100px;">

      <?php if(isset($_SESSION['id'])) { ?>
        <header class="article-header" style="text-align: center;">
  				<div class="article-title">
  					<h1>THIS IS YOUR ACCOUNT</h1>
  				</div>
  				<div class="article-title-metadata">
  					<p>Last Login:<br><span style="font-weight: 200;"><?php echo $_SESSION['last_seen'] ?></span></p>
  				</div>
  			</header>
        <main style="font-size: 16px;max-width: 500px; margin: auto;">
            <p style="font-size: 13px; text-align: center;padding-bottom: 50px;">Currently your Account has very little useful functionality.<br>You can't even change or reset your password yet!<br><br>Someday an account might be a privledge and get you special fancy things!</p>
            <p>Name:<span style="float: right; font-weight: 600;"><?php echo $_SESSION['first']." ".$_SESSION['last'] ?></span></p>
            <p>Account Name:<span style="float: right; font-weight: 600;"><?php echo $_SESSION['uid']?></span></p>
            <p>Email:<span style="float: right; font-weight: 600;"><?php echo $_SESSION['email']?></span></p>
            <!-- <p>Account Age:<span style="float: right; font-weight: 600;">CURRENTLY UNAVAILABLE</span></p> -->
        </main>
      <?php } else { ?>
        <header class="article-header" style="text-align: center;">
  				<div class="article-title">
  					<h1>YOU ARE NOT LOGGED IN</h1>
  				</div>
  				<div class="article-title-metadata">
  					<p>Please Login Below to Access your Account</p>
  				</div>
  			</header>
        <main style="font-size: 16px;max-width: 500px; margin: auto;">
            <form class="form-signin" action="includes/login.inc.php" method="POST">
                <div class="">

                    <div style="position: relative; height: 80%;">
                        <div class="form-input-box">
                            <input class="form-input" type="text" name="uid" placeholder="Username" required>
                        </div>
                        <div class="form-input-box">
                            <input type="password" name="pwd" class="form-input" placeholder="Password" required>
                        </div>
                    </div>
                    <div style="position: relative; height: 50px;margin-top: 35px;">
                        <button style="width: 100%;height: 100%;" class="sign-in-button" type="submit ">Login</button>
                    </div>
                    <div id="login-msg"></div>


                </div>
            </form>
        </main>
      <?php } ?>

		</article>

</div>

<footer>

  <?php
    include 'footer.php';
  ?>

</footer>


<script src="js/jquery.js "></script>
<script src="js/index.js "></script>

<script>
    $('.burger').click(function() {
        $(this).toggleClass('open');
    });

    $("#web-frame").addClass("inactive");
</script>

</body>

</html>
