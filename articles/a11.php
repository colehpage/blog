<h3 class='thumbnail-title'><span class="article-type">[Basketball]</span><br>NBA Team Rankings:<span style="font-size: 18px"><br>First Quarter</span></h3>
<p class="article-description">UNDER CONSTRUCTION</p>

<p class="article-number">11</p>
<p class="article-date">Dec. 2nd 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200;">[Basketball]</span> NBA Team Rankings: First Quarter
			</div>
			<div class="modal-title-mobile">
				Dec 2, 2017
			</div>
			<div class="modal-close">
				<svg class="rb-close" viewbox="0 0 18 17" xmlns="http://www.w3.org/2000/svg">
				<g fill-rule="evenodd">
					<path d="m1881.15 32.13l-7.07-7.07-1.414 1.414 7.07 7.07-7.07 7.07 1.414 1.414 7.07-7.07 7.07 7.07 1.414-1.414-7.07-7.07 7.07-7.07-1.414-1.414-7.07 7.07" fill="#222222" fill="#fff" transform="translate(-1872-25)"></path>
				</g></svg>
			</div>
		</div>

		<article class="article-body">
			<header class="article-header">
				<div class="article-title">
					<h1><span class="pre-header">[Basketball]<br></span>NBA Team Rankings:<br>First Quarter</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published December 2, 2017</p>
				</div>
			</header>
			<main>



			</main>
			<footer>
				<section class="comments" style="display: block;">
					<?php
          if(isset($_SESSION['id'])) {
            echo "<form id='commentform' method='POST' action=' ".setComments($conn)." '>
              <input type='hidden' name='uid' value='".$_SESSION['uid']."'>
              <input type='hidden' name='date' value=' ".date('Y-m-d H:i:s')." '>
              <textarea class='commentarea' name='message'></textarea><br>
              <button form='commentform' id='commentbtn' name='commentSubmit' type='submit' value='submit'>Comment</button>
            </form>";
          }
          else {
            echo "<p style='text-align: center;'>You must be logged in to comment!</p>";
          }

          getComments($conn);

          ?>


				</section>
			</footer>
		</article>

		<div class="article-count">ARTICLE 11</div>

	</div>
