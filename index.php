
<?php
  include 'header.php';
  date_default_timezone_set('America/New_York');
  include 'dbh.php';
  include 'includes/comments.inc.php';

?>

<main>
  <div id="web-frame" class="inactive">
      <section class="home-heading">
          <div class="home-section" style="margin-bottom: 0px;">
            <div class="home-section-inner padding-wrapper" style="">
              <div class="home-section-inner" style="border-bottom: 2px solid #222; margin: 0px; width: 100%;">
                <div class="home-content-holder">
                    <div class="home-content-wrapper ">
                        <h1 class="home-content-Heading " style="font-family: 'Rubik-Black'; "><span style="font-family: 'Rubik-light';">[ALWAYS] </span>TEST TEST UNDER CONSTRUCTION...</h1>

                        <a id="learnmore" href="./about.php" title="Learn More " class="home-content-button " style="font-family: 'Kano-regular'; ">Learn More</a>
                    </div>
                    <div href=" " class="home-content-Caption ">
                        <p class="home-content-CaptionLabel ">NEXT PROJECT</p>
                        <h4 class="home-content-CaptionHeading ">Who is Jordan Bell?</h4>
                        <p class="home-content-CaptionText ">A Statistical look at the former Oregon Fighting Duck and newest Golden State Warrior, Jordan Bell.</p>
                    </div>
                </div>
              </div>
            </div>
          </div>
      </section>


      <section class="home-articles" style="padding-top: 5px;">

        <ul id="articles-grid" class="articles-grid clearfix">

                    <!-- HIDING FOR NOW

          <li class="icon-clima-1 rb-span-2">
            <?php include './articles/a15.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-2">
            <?php include './articles/a14.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-4">
            <?php include './articles/a13.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-2">
            <?php include './articles/a12.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-2">
            <?php include './articles/a11.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-3">
            <?php include './articles/a10.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-1">
            <?php include './articles/a9.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-4">
            <?php include './articles/a8.php'; ?>
          </li>

        -->

          <li class="icon-clima-1 rb-span-1 not-ready">
            <?php include './articles/a8.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-3 not-ready">
            <?php include './articles/a7.php'; ?>
          </li>

          <li class="icon-clima-1 rb-span-2 not-ready">
            <?php include './articles/a6.php'; ?>
					</li>

          <li class="icon-clima-1 rb-span-2 ready">
            <?php include './articles/a5.php'; ?>
					</li>

					<li class="icon-clima-1 rb-span-4 ready">
            <?php include './articles/a4.php'; ?>
					</li>

          <li class="icon-clima-1 rb-span-2 not-ready">
            <?php include './articles/a3.php'; ?>
					</li>

          <li class="icon-clima-4 rb-span-2 ready">
            <?php include './articles/a2.php'; ?>
					</li>

          <li class="icon-clima-1 rb-span-2 not-ready">
            <?php include './articles/a1.php'; ?>
					</li>

          <li class="icon-clima-1 rb-span-2 not-ready">
            <?php include './articles/a0.php'; ?>
					</li>

				</ul>
      </section>

      <section class="end-quote">
        <div class="quote">"TO CONDENSE FACT FROM THE VAPOR OF NUANCE"</div>
      </section>


  </div>
</main>

<footer>

<?php
  include 'footer.php';
?>

</footer>

<script src="js/jquery.fittext.js "></script>
<script src="js/boxgrid.js "></script>
<script src="js/index.js "></script>

<script>
  $(function() {
    Boxgrid.init();
  });
</script>


<script>
    $('.burger').click(function() {
        $(this).toggleClass('open');
    });

    $("#web-frame").addClass("inactive");
</script>

</body>

</html>
