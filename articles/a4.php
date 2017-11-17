
<h3 style="line-height: 30px;"><span class="article-type">[Notes]</span><br>Embedding Jupyter Notebooks</span></h3>
<p class="article-description">UNDER CONSTRUCTION</p>

<p class="article-number">4</p>
<p class="article-date">Aug. 20th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200">[Notes]</span> Embedding IPython Notebooks
			</div>
			<div class="modal-title-mobile">
				August 20, 2017
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
					<h1><span class="pre-header">[Plotly/Dash]<br></span>Embedding IPython Notebooks</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published August 20, 2017</p>
				</div>
			</header>
			<main>

			<p>As discussed in my post on underlying site structure, I have opted to build out every piece of this site from scratch instead of working with static-page generators such as Pelican or Hyde. I discuss the logic behind this choice there, so I wont reiterate, but due to this choice I need to set up processes for displaying work moving forward. Jupyter Notebooks will be the most important and continuous form so I want to explain how I've decided to go about this.</p>


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
