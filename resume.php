
<?php
  include 'header.php';
?>



<div id="web-frame" class="inactive">

  <article class="article-body" style="padding-top: 100px; max-width: 1000px;">
			<header class="article-header" style="text-align: center; margin-bottom: 10px;">
				<div class="article-title">
					<h1>WHO AM I?</h1>
				</div>
				<div class="article-title-metadata">
          <p>Last Updated Nov. 10, 2017</p>
				</div>
			</header>

      <main style="width: 100%; margin: auto;">
          <img src="./img/CHP_Resume.svg">
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
