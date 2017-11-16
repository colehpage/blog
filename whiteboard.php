
<?php
  include 'header.php';
  date_default_timezone_set('America/New_York');
  include 'dbh.php';
  include 'includes/comments.inc.php';
?>



<div id="web-frame" class="inactive">

  <article class="article-body" style="padding-top: 100px;">
			<header class="article-header" style="text-align: center;margin-bottom: 100px;">
				<div class="article-title">
          <h1>WHITEBOARD</h1>
				</div>
				<div class="article-title-metadata">
					<p>Last Updated Apr. 27, 2017</p>
				</div>
			</header>
			<main style="text-align: ; font-size: 18px">

        <section class="" style="margin-bottom: 200px;">
          <h2>COMMENT SECTION WORK</h2><br>

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


        <section style="margin-bottom: 100px;">
          <h2>BASIC CALCULATOR</h2><br>
          <form>
            <input type="text" name="num1" placeholder="Number 1" style="border: 1px solid black; padding: 10px;">
            <input type="text" name="num2" placeholder="Number 2" style="border: 1px solid black; padding: 10px;">
            <select name="operator" style="border: 1px solid black; padding: 10px;">
              <option>NONE</option>
              <option>ADD</option>
              <option>SUBTRACT</option>
              <option>MULTIPLY</option>
              <option>DIVIDE</option>
            </select>
            <br>
            <button type="submit" name="submit" value="submit" style="margin-top: 20px; border: 1px solid black; padding: 10px;">CALCULATE</button>
          </form>

          <p style="margin-top: 20px;">The answer is:</p>

          <?php
          if (isset($_GET['submit'])) {
            $result1 = $_GET['num1'];
            $result2 = $_GET['num2'];
            $operator = $_GET['operator'];
            switch ($operator) {
              case "NONE":
                echo "You need to select a method!";
              break;
              case "ADD":
                echo $result1 + $result2;
              break;
              case "SUBTRACT":
                echo $result1 - $result2;
              break;
              case "MULTIPLY":
                echo $result1 * $result2;
              break;
              case "DIVIDE":
                echo $result1 / $result2;
              break;
            }
          }

           ?>
         </section>


         <section style="margin-bottom: 100px;">
           <h2>DAY OF THE WEEK</h2><br>
           <?php

           $dayofweek = date('w');

           switch ($dayofweek) {
             case 1:
              echo '<p>It is MONDAY!</p>';
             break;
             case 2:
              echo 'It is TUESDAY!';
             break;
             case 3:
              echo 'It is WEDNESDAY!';
             break;
             case 4:
              echo 'It is THURSDAY!';
             break;
             case 5:
              echo 'It is FRIDAY!';
             break;
             case 6:
              echo 'It is SATURDAY!';
             break;
             case 0:
              echo 'It is SUNDAY!';
             break;

           }
            ?>

        </section>




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
