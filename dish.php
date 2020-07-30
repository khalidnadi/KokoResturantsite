<?php
include("includes/init.php");

$title = "dish";
$index = "current";

$db = open_or_init_sqlite_db('secure/site.sqlite', 'secure/init.sql');

// code referenced from lecture 18
if (isset($_GET['id'])) {
    $menu_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $sql = "SELECT * FROM menu WHERE id = :id;";
    $params = array(
        ':id' => $menu_id
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
        $menus = $result->fetchAll();
        if (count($menus) > 0) {
            $menu = $menus[0];
        }
    }
    $sql = "SELECT diets.diet FROM diet_tags LEFT OUTER JOIN diets ON diet_tags.diet_id = diets.id WHERE menu_id = :id;";
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
        $diet_tags = $result->fetchAll();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/dish.js"></script>

    <title>Dish</title>
</head>

<body>

    <!-- TODO: This should be your main page for your site. -->
    <?php include("includes/header.php"); ?>

    <main id="dish_main">
        <h2><?php echo htmlspecialchars($menu["menu_name"]) ?></h2>

        <div id="single_menu">

            <?php
            $sql = "SELECT * FROM images WHERE menu_id = :id";
            $params = array(
                ':id' => $_GET["id"]
            );
            $image_records = exec_sql_query($db, $sql, $params)->fetchAll();

            if (sizeof($image_records) == 0) {
                echo "<h3> No images available. </h3>";
            } else { ?>
                <div id="dish_slideshow">
                    <p id="slide_prev">&#10094;</p>
                    <?php
                    echo "<script> var image_sources = new Array();";
                    foreach ($image_records as $image_record) {
                        echo "image_sources.push('uploads/" . $image_record["id"] . "." . $image_record["image_ext"] . "');";
                    }
                    echo "</script>";

                    echo "
                    <img id='slide_image' alt = 'dish' src='uploads/" . $image_records[0]["id"] . "." . $image_records[0]["image_ext"] . "'>";
                    ?>
                    <p id="slide_next">&#10095;</p>
                    <div id="slide_dots">
                        <?php
                        for ($i = 0; $i < sizeof($image_records); $i++) {
                            if ($i == 0)
                                echo "<p class='slide_dot selected_dot'></p>";
                            else
                                echo "<p class='slide_dot'></p>";
                        }
                        ?>
                    </div>
                </div>
            <?php
        } ?>

            <div id="menu_info">
                <p class="single_info">
                    <strong>Description:</strong> <?php echo htmlspecialchars($menu["description"]) ?>
                </p>
                <p class="single_info">
                    <strong>Price:</strong> $<?php echo htmlspecialchars($menu["price"]) ?>
                </p>
                <div class="single_info">
                    <p>
                        <strong>Diets:</strong>
                    </p>
                    <ul id="diet_list">
                        <?php
                        foreach ($diet_tags as $diet_tag) {
                            ?>
                            <li><?php echo htmlspecialchars($diet_tag["diet"]) ?></li>
                        <?php
                    } ?>
                    </ul>
                </div>
            </div>
        </div>

    </main>

    <?php include("includes/footer.php"); ?>

</body>

</html>
