
<?php
  include 'header.php';
?>



<div id="web-frame" class="inactive">

  <article class="article-body" style="padding-top: 100px;">
			<header class="article-header" style="text-align: center;">
				<div class="article-title">
					<h1>WHAT IS THIS PLACE?</h1>
				</div>
				<div class="article-title-metadata">
          <p>Last Updated Nov. 10, 2017</p>
				</div>

			</header>
			<main style="text-align: center; font-size: 18px">
        <p>This is the first iteration of Mercurial Analytics, a public sandbox for <a class="author" href="https://colehpage.github.io" target="_blank" rel="author">Cole Page</a>.</p>
        <p>It is an online platform for him to test and play with various skills, languages, and tools as he learns them. It is both a blog publishing data driven articles as well as a giant digital whiteboard</p>
        <p>The primary responsiblity of data scientists and programmers is to learn. Tools, languages, and methods are constantly changing and each change adds and alters how you approach problem solving.</p>
        <p>Throughout this iteration no work will truly be complete. Many pieces may seem broken, unfinished, or pointless as new skills are learned and pieces added.</p>
        <p>Don’t expect anything to work how you think it should, it won’t, but the data being used as well as the accompanying insights and opnions are real.</p>
        <p>Current work includes topics in Data Science, Machine Learning, Sports Analytics, Python, R, Matlab, C, Javascript/jQuery, PHP, HTML/CSS, MYSQL, and others.
        <p>The next iteration may be something wholey different, but for now:</p>
        <p>This is simply a digital notebook, publication, canvas, and autodidact playground.</p>
        <p>Enjoy.</p>
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
