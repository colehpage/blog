
<h3 style="line-height: 30px;">Stanford University's CS231n: <br><span style="font-size: 20px;">Convolutional Neural Networks for Visual Recognition</span></h3>
<p style="font-size: 12px">Feeling a little rusty on my basic deep learning skills, I have decided to spend the next few weeks working through Stanford University's class, CS231n: Convolutional Neural Networks for Visual Recognition. Much of the material, especially the raw Python, is simply a refresher for me, but a lot of the application is new as I have not worked extensivly on applying machine learning to imaging problems. As I work through the class I will be putting up my thoughts, notes, assignments, and IPython Notebooks up here as a way to keep myself honest and motivated to progress through the class in it's entirety.</p>

<p class="article-number">4</p>
<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
	<div class="modal-navigation">
		<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
		<div class="modal-title">
			CS231n: Convolutional Neural Networks for Visual Recognition
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
				<h1>Stanford University's CS231n: <span style="font-size: 24px;"><br>Convolutional Neural Networks for Visual Recognition</span><br><span style="display: none; font-size: 16px;">Notes, Thoughts, Assignments, and Progress</span></h1>
			</div>
			<div class="article-title-metadata">
				<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
				<p>Published June. 22, 2017</p>
			</div>
		</header>
		<main>

		<div class="article_content">


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

	<div class="article-count">ARTICLE 4</div>

</div>
