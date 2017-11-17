

<h3 style="line-height: 30px;">Underlying Structure Choices</span></h3>
<p class="article-description">UNDER CONSTRUCTION</p>

<p class="article-number">1</p>
<p class="article-date">Apr. 30th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				Underlying Structure Choices
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
					<h1>Underlying Structure Choices</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published April 30, 2017</p>
				</div>
			</header>
			<main>
				<div class="article-content">
					<p>I want to take a second to talk about some of the choices I have made in regards to the structure of this site moving forward. These days there are endless paths to go down depending on what kind of site or blog you are trying to set up. Packages such as Pelican and Hyde make it extreamly easy to write, publish, and push content in a simple, effective, and reproductable way and platforms like Wordpress and GitHub Pages make publishing static content a breeze for beginners and experts alike. </p>
					<p>Normally, since I plan to consitantly produce material I would go with one of these templated options, but the point of this site is much more than simply a blog. First off, there are portions of this site that will not be static and that pretty much rules out any of the former options. Second, a large part of this site is about design, not just function, and I want complete control over every line of code and pixel, even if that makes each post creation a little more tedious and drawn-out.</p>
					<p>........</p>
					<p>Eventually color by article topics?</p>
				</div>

			</main>
			<footer>
				<section class="comments" style="display: none;">
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

		<div class="article-count">ARTICLE 1</div>

	</div>
