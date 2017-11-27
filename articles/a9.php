<h3 class='thumbnail-title'><span class="article-type">deeplearning.ai</span><br>Week 1:<span style="font-size: 18px"><br>Introduction to Deep Learning</span></h3>
<p class="article-description">It has been almost a year since I finished Andrew Ng's famous course on Machine Learning. It lived up to it's immense hype and then some, so naturally when I started to get the itch to take a new class I quickly stumbled across his deep learning, 5 course AI specilization track and figured I'd give it a try. Over the next few weeks, in and around my research, blogging, and job hunt I plan to log my progress through the course here in a series of posts.</p>

<p class="article-number">9</p>
<p class="article-date">Nov. 25th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200;">[deeplearning.ai]</span> Week 1: Introduction to Deep Learning
			</div>
			<div class="modal-title-mobile">
				Nov 25, 2017
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
					<h1><span class="pre-header">[deeplearning.ai]<br></span>Week 1:<br>Introduction to Deep Learning</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published November 25, 2017</p>
				</div>
			</header>
			<main>
				<p>It has been almost a year since I finished Andrew Ng's famous course on Machine Learning. It lived up to it's immense hype and then some, so naturally when I started to get the itch to take a new class I quickly stumbled across his deep learning, 5 course AI specilization track and figured I'd give it a try. Over the next few weeks, in and around my research, blogging, and job hunt I plan to log my progress through the course here in a series of posts. If you want to learn more or check it out yourself head over to <a href="https://www.coursera.org/specializations/deep-learning">Coursera</a> and although you need a $49/month subscription you can check out the course with a free 7 day trial before spending the cash, which in my opinion is well worth it.</p>
				<p></p>



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

		<div class="article-count">ARTICLE 9</div>

	</div>
