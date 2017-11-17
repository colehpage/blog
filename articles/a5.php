
<h3><span style="font-size: 25px; font-weight: 200; line-height: 50px;">An Exploration into Plotly's <u>Dash</u>:</span><br>Live NBA Line Movements</h3>

<p class="article-description">Always in search of new data viszualization methods and tools, I recently came across Dash, a Python framework built on top of Plotly.js, React, and Flask with the purpose of building analytical web applications completely in Python. Dash works as the frontend to our analytical Python backend. In order to get a feel for the platform I decided to build out a sample application that uses many of Dash's features.</p>

<p class="article-number">5</p>
<p class="article-date">Nov. 16th 2017</p>
	<div class="rb-overlay" style="overflow-y: scroll; background-color: white;">
		<div class="modal-navigation">
			<div class="modal-branding"><img class="rb-logo" src="./img/ma_logo.svg" style="cursor: default;"></div>
			<div class="modal-title">
				<span style="font-weight: 200;">An Exploration into Plotly's <u>Dash</u>:</span> Live NBA Line Movements
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
					<h1><span style="font-size: 25px; font-weight: 200;">An Exploration into Plotly's <u>Dash</u>:</span><br>Live NBA Line Movements</h1>
				</div>
				<div class="article-title-metadata">
					<p>By <a class="author" href="./resume.php" rel="">Cole Page</a></p>
					<p>Published November. 16, 2017</p>
				</div>
			</header>
			<main>
				<h2>What is Dash?</h2>

							<img src='./img/a6/dash.png' width=400 height=250 style="margin-top: 20px; margin-bottom: 50px;">

				<p><a href="https://plot.ly/products/dash/">Dash</a> is an Open Source Python library for creating reactive, Web-based applications. Dash makes it extreamly easy to build a GUI or live visualization around your data analysis code, all without stepping outside of the Python language. Dash apps are viewed in the web browser without the need for any user built javascript or HTML, instead using a growing set of interactive web-based components to bind custom data analysis in Python to your Dash user interface.</p>

				<p>Dash applications are web servers running Flask and communicating JSON packets over HTTP requests. Dash’s frontend renders components using React.js, the Javascript user-interface library written and maintained by Facebook. As Plotly puts it: "Dash leverages the power of Flask and React, putting them to work for Python data scientists who may not be expert Web programmers."</p>

				<p>Dash components are Python classes that encode the properties and values of a specific React component and that serialize as JSON. While Dash ships with a large array of components that are easy to use out of the box, you are not limited to them alone. It is easy to port in your own React.js components for use in Dash applications, leaving the possibilities pretty endless.</p>

				<p>Charts are rendered with plotly.js (on top of D3.js and WebGL) sharing the same libraries and syntax, allowing developers to write Dash applications with the same functionality as any Plotly chart. Check out the <a href="https://plot.ly/dash/">Dash User Guide</a> to learn more!</p>

				<h2>Sample Application:</h2>
				<p>Per usual, since I learn better by doing than simply reading, I decided to build out my own sample Dash application as a crash course into the framework. I tried to incorporate as many of the core Dash components as possible with a main focus on exploring the Live Updates module.</p>
				<p>Recently, I built a scraping/database system for the daily collection and storage of lines and odds movements for NBA games. (See article on <a href="">Postgres and BeautifulSoup4</a> for more details) Since I have this database growing away in the background I figured why not use the data it's collecting as the food for this sample Dash Application!</p>
				<p>The goal of this application was to provide a Live Updating Dashboard that displays real-time betting line movements for NBA games. The initial goal was to simply pull live data from my database and display second by second updates for each team's spread and total line movements.</p>

				<p>I'm going to write a bit more about the development process, issues, things to fix, additions, etc... But for now here is a link to the working application. At the moment it runs pretty slow as the database queries are pinging off my home server, none of it is opitimized for real web traffic, and the hosting is using a free Heroku Deployment server. Thus at the moment, on your system it may take a long time to update components or it may not load at all.</p>

				<p>DASHBOARD: <a href=" https://nba-line-movements.herokuapp.com/"> https://nba-line-movements.herokuapp.com/</a></p>

				<video style="margin-top: 50px;" width="1000" autoplay loop>
				  <source src="./mov/dashboard_screencast.mp4" type="video/mp4">
				Your browser does not support the video tag.
				</video>

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

		<div class="article-count">ARTICLE 5</div>

	</div>
