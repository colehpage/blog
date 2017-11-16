
<?php
  include 'header.php';
?>



<div id="web-frame" class="inactive">

  <section class="coming-soon" style="height: 80vh; max-width: 1000px; width: 90%; margin: auto;">

    <div class="coming-soon-banner" style="padding-top: 25%; text-align: center; font-size: 40px;font-weight: 600;">
      PAGE <BR> UNDER CONSTRUCTION
    </div>

  </section>

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
