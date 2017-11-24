

<h3><span class="article-type">Notes</span><br>Underlying Structure Choices</span></h3>
<p class="article-description">I want to take a second to talk about some of the choices I have made in regards to the structure of this site moving forward. With all the frameworks, languages, platforms, and development pipelines available these days there are an endless number of routes you can take when starting a website or blog. Depending on what your personal or public goals are the route you take can be as easy or hard as you choose. In this post I'll give you some logic behind some of my technical choices as well as a little explanation of the aesthetic direction.</p>

<p class="article-number">1</p>
<p class="article-date">Apr. 30th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200">[Notes]</span> Underlying Structure Choices
			</div>
			<div class="modal-title-mobile">
				April 30, 2017
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
					<h1><span class="pre-header">[Notes]<br></span>Underlying Structure Choices</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published April 30, 2017</p>
				</div>
			</header>
			<main>
				<div class="article-content">
					<p>I want to take a second to talk about some of the choices I have made in regards to the structure of this site moving forward. With all the frameworks, languages, platforms, and development pipelines available these days there are an endless number of routes you can take when starting a website or blog. Depending on what your personal or public goals are the route you take can be as easy or hard as you choose. In this post I'll give you some logic behind some of my technical choices as well as some explanation of my aesthetic motivations. The way I see it this site was created to showcase and facilitate my growth in four major areas: 1. <b>Data Science/Analytics</b> 2. <b>Back-End Programming</b> 3. <b>Front-End Programming</b> 4. <b>Writing</b></p>

					<p>In no way do I recommend the choices I've made to anyone else nor do I believe they are efficient for anything other than my own personal growth. Many of them will greatly increase the time certain tasks take, and from an ease of deployment perspective they will often be straight up masochistic. Think of it as eschewing word-processors and printers while writing a novel, and instead hammering away at a typewriter using ink you made with wild berries and handmade paper from a tree you cut down with a sharp stone. Brutal sure, but worth it for the option of rarely if ever being held back by someone else’s decisions. Of course often I will choose to not reinvent the wheel and take the shortcut, but I want to leave myself the option not to from the start.</p>

					<p>As I alluded to earlier, a lot of really smart and creative people have slept very little and worked way to hard to make our lives as programmers, developers, and designers easy. In the web world amazing packages such as Pelican and Hyde make it extremely easy to write, publish, and push content in a simple, effective, and reproducible way and platforms like Wordpress and GitHub Pages make producing static content a breeze for beginners and experts alike. They allow us to focus more on the content and less on the vehicle that get's it to the readers.</p>

					<p>Normally, since my main focus here is to consistently produce material and showcase the research and ideas I'm working on, the smartest option would be one of these template frameworks, but there are just so many more things I want to do that are just not possible through static site generators. Developing dynamic back-end skills, live updating applications, and database skills to name a few all require getting a lot more under the hood.</p>

					<p>Although there isn't any real account functionality right now, I wanted to leave myself open to eventually incorporating a paid "insider" aspect of the site as well as various interactive ideas that are bouncing around my head that would rely on dynamic content. I could of course still use a few shorts for producing basic article content and blog posts, but in order to really learn concepts A-Z I think they will only hinder me in the long run.</p>

					<p>A large part of this site is about design, not just function, and I want complete control over every line of code and pixel, even if that makes each post creation a little more tedious and drawn-out. The aesthetic is meant to be simple, minimalist, slick, but not gaudy or flashy. Responsive, mobile, and smooth but not overly engineered and designed into the ground. The purpose isn't to awe but to feel comfortable, an experience somewhere between reading a good newspaper spread and a well put together white paper. Post to post I am to keep many structural pieces the same but layout will certainly not feel the same overtime and will most likely change based on how I'm feeling that day. I've made very few choices at time of writing this, so for the most part we'll just have to wait and see what happens!</p>
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

		<div class="article-count">ARTICLE 1</div>

	</div>
