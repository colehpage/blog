
<h3 style="line-height: 30px;"><span class="article-type">Notes</span><br>Embedding Jupyter Notebooks</span></h3>
<p class="article-description">Jupyter Notebooks are one of the more constant tools I use in my workflow so I want to quickly go through my process of converting them to embedded HTML that is usuable in these posts moving forward. For this I have decided to use <u>nbconvert</u>, a Jupyter Notebook conversion tool, built on top of <u>Jinja</u> that allows researchers/scientists to quickly and easily deliver results across a number of static mediums.</p>

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
					<h1><span class="pre-header">[Notes]<br></span>Embedding Jupyter Notebooks</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published August 20, 2017</p>
				</div>
			</header>
			<main>

			<p>As discussed in my post on underlying site structure, I have opted to build out every piece of this site from scratch instead of working with static-page generators such as Pelican or Hyde. I discuss the logic behind this choice there, so I wont reiterate, but due to this choice I need to set up processes for displaying work moving forward. Jupyter Notebooks are one of the more constant tools I use in my workflow so I want to quickly go through my process of converting them to embedded HTML that is usuable in these posts moving forward.</p>

			<p>For this I have decided to use <a href="https://nbconvert.readthedocs.io/en/latest/#">nbconvert</a>, a Jupyter Notebook conversion tool, built on top of <a href="http://jinja.pocoo.org/">Jinja</a> that allows researchers/scientists to quickly and easily deliver results across a number of static mediums such as PDF, LaTeX, and HTML. In this site I will be utilizing the HTML output format, which allows you to tweak the templating and customize the HTML static rendering.</p>

			<p>Nbconvert uses two primary methods of conversion, first a command line script that inputs .ipynb files and outputs the desired static format, and second programmatically as a Python library. The latter is fantastic for use with static site generators such as <a href="http://docs.getpelican.com/en/stable/">Pelican</a> since it works in memory to dynamically convert notebooks inside a publishing pipeline without ever having to read or write from disk. That being said, since I have opted for a non-static blog where I force myself to code every piece from scratch, I will be using the command line method to generate static HTML which I then manually fold into each article's PHP file. While this might not be very practicle in a production environment, it works great for the purpose of this platform.</p>

			<p>Installation is as simple as a conda or pip package install, and for basic ipynb -> html conversion no other packages are required. For other format conversion nbconvert uses <a href="http://pandoc.org">Pandoc</a> or your OS's TeX distribution.</p>

			<p>Command line usage is very simple and the basic format is as follows:</p>
			<div class="highlight-default">
				<div class="highlight">
					<pre><span></span>$ jupyter nbconvert --to FORMAT notebook.ipynb</pre>
				</div>
			</div>
			<p>The default output format is HTML, for which the --to argument may be omitted, so implementation gets even easier:</p>
			<div class="highlight-default">
				<div class="highlight">
					<pre><span></span>$ jupyter nbconvert notebook.ipynb</pre>
				</div>
			</div>

			<p>As I stated earlier, one of the great aspects of nbconvert is the ability to use templates by adding the --template argument to the above command. Jupyter provides a few templates, <code>--template full</code> which produces a full static HTML render that looks very similar to the interactive view and <code>--template basic</code> which produces a simplified version for basic webpage/blog embedding.</p>

			<p>For now I will be using the <code>--template basic</code> for my posts with a few simple css changes to hide or show functionality. The two main additions are hiding the display of the input prompts and some added margin to the rendered boxes, simple stuff. The basic template is simple, clear, and displays everything well enough for the time being. Down the road I plan on creating a custom template and when I do I will document my thought process. In addition, prior to a custom template, it's easy to simple add css properties to any rendered HTML from the basic template to make small changes as you go.</p>

			<p>The next and last step is to include the newly created static HTML and it is very simple. If you wanted you could just open the created HTML file and copy/paste the code into the given article PHP file, but this is sloppy. For larger notebooks the rendered static code can be hundreds lines of not particularly aesthetic code and just dropping it in makes editing and making changes to each article a mess. Instead you can just use a <b>w3-include-html</b> attribute and a tiny bit of javascript.</p>

			<div class="w3-example" style="text-align: left;">
			    <div class="w3-code notranslate htmlHigh" style="font-size: 11px">
			        <span style="color:brown"><span style="color:mediumblue">&lt;</span>html<span style="color:mediumblue">&gt;</span></span>
			        <br><span style="color:brown"><span style="color:mediumblue">&lt;</span>script<span style="color:red"> src<span style="color:mediumblue">="https://www.w3schools.com/lib/w3.js"</span></span><span style="color:mediumblue">&gt;</span></span><span style="color:black"></span><span style="color:brown"><span style="color:mediumblue">&lt;</span>/script<span style="color:mediumblue">&gt;</span></span>
			        <br><span style="color:brown"><span style="color:mediumblue">&lt;</span>body<span style="color:mediumblue">&gt;</span></span><br>
			        <br><span style="color:brown"><span style="color:mediumblue">&lt;</span>div<span style="color:red"> w3-include-html<span style="color:mediumblue">="content.html"</span></span><span style="color:mediumblue">&gt;</span></span><span style="color:brown"><span style="color:mediumblue">&lt;</span>/div<span style="color:mediumblue">&gt;</span></span>
			        <br>
			        <br><span style="color:brown"><span style="color:mediumblue">&lt;</span>script<span style="color:mediumblue">&gt;</span></span><span style="color:black"><br><span style="color:red">
							</span> w3.<span style="color:black">includeHTML</span>();
			        <br>
			        </span><span style="color:brown"><span style="color:mediumblue">&lt;</span>/script<span style="color:mediumblue">&gt;</span></span><br>
			        <br><span style="color:brown"><span style="color:mediumblue">&lt;</span>/body<span style="color:mediumblue">&gt;</span></span>
			        <br><span style="color:brown"><span style="color:mediumblue">&lt;</span>/html<span style="color:mediumblue">&gt;</span></span>
			    </div>
			</div>

			<p>As the sample above shows, this is a very quick couple of lines of code, and keeps the messy nbconvert output hidden away in it's own space. This also allows multiple includes for long articles to be seemlessly added in and around the article's HTML and PHP. Make sure you have the w3.js script included, then throw in the w3 attribute div wherever you want the notebook placed, and make sure to include the w3.includeHTML() call. That's all there is to it!</p><br><br>

			<div w3-include-html="./notebooks/a4/nbconvert_example.html"></div>

			<script>
				w3.includeHTML();
			</script>


			<br><br><p style="font-size: 10px; text-align: center;"><br>For more information on nbconvert check out their docs: <a href="https://nbconvert.readthedocs.io/en/latest/#">https://nbconvert.readthedocs.io/en/latest/#</a></p>


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

		<div class="article-count">ARTICLE 4</div>

	</div>
