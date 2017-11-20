
<h3 style="color: #fff !important;"><span class="article-type">[The Beginning]</span><br>Mercurial Analytics:<br><span style="font-size: 18px;">Iteration Zero</span></h3>
<p class="article-description" style="color: #fff !important;">This is the first iteration of Mercurial Analytics, a sort-of public sandbox and playground of ideas, work, and musings belonging to Cole Page. Right now a fairly abstract curvey idea, it may eventually coelesce into something stable and with purpose, or it may not...</p>
<p class="article-number" style="color: #fff !important;">0</p>
<p class="article-date" style="color: #fff !important;">Apr. 27th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				Mercurial Analytics: <span style="font-weight: 200">Iteration Zero</span>
			</div>
			<div class="modal-title-mobile">
				April 27, 2017
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
					<h1 style="line-height: 30px;">Mercurial Analytics:<br><span style="font-weight: 200; font-size: 20px">Iteration Zero</span></h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published April 27, 2017</p>
				</div>
			</header>
			<main>

				<p>This is the first iteration of Mercurial Analytics, a public sandbox for me: <a class="author" href="https://colehpage.github.io" target="_blank" rel="author">Cole Page</a>.</p>

				<p>Mercurial describes a person, or in this case the work produced by a person (me), that is subject to sudden or unpredictable changes of mood or mind. Sometimes a postive, sometimes not so much, this is for better or worse how my mind works. The work here will be anything but linear, and 100% dictated by my fairly capricious daily interests.</p>

        <p>This first iteration of Mercurial Analytics will be an online platform for me to test and play with various skills, languages, and tools as I learn them. It will be a blog of sorts, publishing data driven articles on an array of topics, but mostly the plan is for it to be an expansive digital whiteboard that never gets erased and houses all manner of thoughts, from complete and thought out to utterly uncoherently rambling.</p>

        <p>The primary responsiblity of data scientists, progammers, statisticians, and academics is to learn. Tools, languages, methods and skills are constantly changing and evolving and each iteration and advancement adds and alters how you approach problem solving.</p>

        <p>Throughout this iteration no work will truly be complete. Many pieces may seem broken, articles unfinished, or functionality pointless as new skills are learned, added, and incorporated into the greater amalgam. I am (at least presently) a fairly atrocious writer, so don't expect any mind-blowing prose. I would love to get better and eventually I hope to, but that is not the primary, secondary, or even tertiery purpose of this place.</p>

        <p>Don’t expect anything to work how you think it should, it won’t, but the data being used as well as the accompanying insights and opnions will be real and at least semi thought out. My opinions will always be right, and yet quite often very wrong and that's okay because this is my whiteboard and I hold all the markers. There are plenty of spaces for collaborative inclusive discussion out there, this is not one of them. This is not a public park, this is my backyard so hang out, observe, and enjoy or go ahead and get off my lawn!</p>

        <p>The next iteration may be something wholey different, I have some decently vague, possibly interesting, ideas for iteration two's direction, but for now:</p>

        <p>This is simply a digital notebook, publication, canvas, and autodidact playground.</p>
        <p>Enjoy. Or ya know, don't....</p>

        <span style="font-size: 10px;"><br><br>P.S. If for some insane reason you want to pay me to do anything give me a shout with your ill-advised proposition: <b>coleatmercurialanalyticsdotcom</b></span>

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

		<div class="article-count">ARTICLE 0</div>

	</div>
