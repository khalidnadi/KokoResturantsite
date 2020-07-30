<?php
include("includes/init.php");
$db = open_or_init_sqlite_db('secure/site.sqlite', 'secure/init.sql');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Photo Gallery</title>
</head>

<body>

  <?php include("includes/header.php"); ?>

  <main id="delete_main">
    <?php if ($current_user == null) {
      echo "<h2 class='delete_alert'> Not Authorized </h2>";
    } else {
      if (isset($_GET["deleter"])) {
        //DELETE IMAGE
        $sql = "SELECT * FROM images WHERE id = :id;";
        $params = array(
          ':id' => $_GET["deleter"]
        );
        $records = exec_sql_query($db, $sql, $params)->fetchAll();
        if ($records) {
          foreach ($records as $record) {
            $sql = "DELETE FROM images WHERE id = :id;";
            $params = array(
              ':id' => $record["id"]
            );
            $records = exec_sql_query($db, $sql, $params);
            if ($records) {
              $filenames = glob("./uploads/" . $_GET["deleter"] . ".*");
              if (unlink($filenames[0])) {
                echo "<h2 class='delete_alert'> Image deleted </h2>";
                echo "<a id='deleteBack' href='gallery.php'><h2>Back To Gallery</h2></a>";
              }

              echo "<h2 class='delete_alert'> Image deleted </h2>";
              echo "<a id='deleteBack' href='gallery.php'><h2>Back To Gallery</h2></a>";
            } else {
              echo "<h2 class='delete_alert'> Failed to delete image </h2>";
            }
          }
        }
      } else {
        echo "<h2 class='delete_alert'> No such image </h2>";
      }
    } ?>
  </main>
</body>

<?php include("includes/footer.php"); ?>

</html>
