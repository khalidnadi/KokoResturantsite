<?php
include("includes/init.php");

$title = "contact";
$index = "current";

$db = open_or_init_sqlite_db('secure/site.sqlite', 'secure/init.sql');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

    <title>Contact</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <main id="contact_main">
        <?php if ($current_user == null) {
            include("includes/contact.php"); ?>
        <?php  } ?>
        <?php
        if ($current_user == null) {
            if (isset($_GET["submit"])) {
                echo ($messeges2);
                include("includes/login.php");
                ?>
            <?php
        } else {
            ?>
            <?php
        }
    }
    ?>
    </main>

    <?php include("includes/footer.php"); ?>

</body>

</html>
