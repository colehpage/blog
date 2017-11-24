<h3><span class="article-type">Notes</span><br>Moving Apartments!</h3>
<p class="article-description">Next week I'm moving into a new apartment so I will probably be a little bit dormant here for the next month or two while I get settled. See ya in a bit!</p>

<p class="article-number">3</p>
<p class="article-date">May. 18th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200;">[Notes]</span> Moving Apartments!
			</div>
			<div class="modal-title-mobile">
				May 18, 2017
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
					<h1><span class="pre-header">[Notes]<br></span>Moving Apartments!</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published May 18, 2017</p>
				</div>
			</header>
			<main>
				<div class="two-column-article">
					<div class="left-column">

						<p>Don't get used to posts like this, I truley abhor blogging in general and am going to keep this site to analtical, academic, and sports musings not self-obsessed posts about the meaningless (to you) things I did over the preceding days. I am not nearly talented enough of a writer to make narcicisstic millenial ramblings appealing to anyone who doesn't list a social media platform as their primary occupation. Anyway....</p>

						<p>Big week next week over here in Philadelphia! Leaving the comfy confines of my little studio apartment and moving in with a SO for the first time! Been practicing putting the seat down for weeks now so dont worry, I'm pretty sure I'm completely ready for this change. That's all there is to it right? We found an awesome two-bedroom up in Fishtown, which is a rapidly growing area of northern Philly. It's still a few years away from fully blowing up but it kind of feels like Phillys much smaller Brooklyn circa 2003 (I think?? I truley have no clue, I was 13 and in California in 2003 but I've heard people say this).</p>

						<p>The space is amazing, and two bedrooms means I get to have my first real office that's not within a foot of my bed, woohoo! We have about 20 times more space than furnature and belongings so I have a feeling it's going to take a lot of craigslist diving and Ikea trips to feel even remotely moved in. We also have an awesome little real grass dog park on the roof of the building, so fingers crossed it's finally almost time for another member of the family!</p>

						<p>See ya in a few....</p>

					</div>
					<div class="right-column column-centered-image ">
						<img src="./img/a3/moving.jpg" style="width: 300px">
					</div>
				</div>
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

		<div class="article-count">ARTICLE 3</div>

	</div>
