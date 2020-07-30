<?php
include("includes/init.php");

$title = "index";
$index = "current";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="styles/all.css" media="all" rel="stylesheet" type="text/css">
  <title>Home</title>
</head>

<body>
  <?php include("includes/header.php"); ?>

  <main id="home_main">
    <div id="home_header">
      <h2>Welcome to KoKo!</h2>
    </div>
    <p id="home_intro">
      Ithaca's Best Korean Restaurant
    </p>
    <h3 class="home_h3">Top Menus</h3>
    <a id="home_menulink" href="menu.php">Show All</a>
    <div id="home_topmenus">
      <div class="home_topmenu">
        <img alt="menu1" src="images/home1.jpg" />
        <p> Mul Naeng Myun </p>
      </div>
      <div class="home_topmenu">
        <img alt="menu2" src="images/home2.jpg" />
        <p> Budae Jjigae </p>
      </div>
      <div class="home_topmenu">
        <img alt="menu3" src="images/home3.jpg" />
        <p> Doobu Kimchi Bokeum </p>
      </div>
    </div>

  </main>

  <?php include("includes/footer.php"); ?>

</body>

</html>
