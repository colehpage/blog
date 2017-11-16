
<?php
  include 'header.php';
?>



<div id="web-frame" class="inactive">

  <article class="article-body" style="padding-top: 100px;">
			<header class="article-header" style="text-align: center;">
				<div class="article-title">
					<h1>FAQ</h1>
				</div>
				<div class="article-title-metadata">
					<p>Last Updated Apr. 20, 2017</p>
				</div>
			</header>
			<main style="text-align: center; font-size: 18px">
        <p>No Questions Have Been Asked Yet!</p>
			</main>
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
