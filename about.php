
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
			<main class="about-section" style="text-align: center; font-size: 18px">
        <p>This is the first iteration of Mercurial Analytics, a public sandbox for me: <a class="author" href="https://colehpage.github.io" target="_blank" rel="author">Cole Page</a>.</p>

        <p>Mercurial describes a person, or in this case the work produced by a person (me), that is subject to sudden or unpredictable changes of mood or mind. Sometimes a postive, sometimes not so much, this is for better or worse how my mind works. The work here will be anything but linear, and 100% dictated by my fairly capricious daily interests.</p>

        <p>This first iteration of Mercurial Analytics will be an online platform for me to test and play with various skills, languages, and tools as I learn them. It will be a blog of sorts, publishing data driven articles on an array of topics, but mostly the plan is for it to be an expansive digital whiteboard that never gets erased and houses all manner of thoughts, from complete and thought out to utterly uncoherently rambling.</p>

        <p>The primary responsiblity of data scientists, progammers, statisticians, and academics is to learn. Tools, languages, methods and skills are constantly changing and evolving and each iteration and advancement adds and alters how you approach problem solving.</p>

        <p>Throughout this iteration no work will truly be complete. Many pieces may seem broken, articles unfinished, or functionality pointless as new skills are learned, added, and incorporated into the greater amalgam. I am (at least presently) a fairly atrocious writer, so don't expect any mind-blowing prose. I would love to get better and eventually I hope to, but that is not the primary, secondary, or even tertiery purpose of this place.</p>

        <p>Don’t expect anything to work how you think it should, it won’t, but the data being used as well as the accompanying insights and opnions will be real and at least semi thought out. My opinions will always be right, and yet quite often very wrong and that's okay because this is my whiteboard and I hold all the markers. There are plenty of spaces for collaborative inclusive discussion out there, this is not one of them. This is not a public park, this is my backyard so hang out, observe, and enjoy or go ahead and get off my lawn!</p>

        <p>The next iteration may be something wholey different, I have some decently vague, possibly interesting, ideas for iteration two's direction, but for now:</p>

        <p>This is simply a digital notebook, publication, canvas, and autodidact playground.</p>
        <p>Enjoy. Or ya know, don't.... totally up to you</p>

        <span style="font-size: 10px;"><br><br>P.S. If for some insane reason you want to pay me to do anything give me a shout with your ill-advised proposition: <b>coleatmercurialanalyticsdotcom</b></span>
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
