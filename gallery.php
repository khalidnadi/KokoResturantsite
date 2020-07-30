<?php
include("includes/init.php");

$title = "gallery";
$index = "current";

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
    <?php include("includes/header.php");

    $image_records = exec_sql_query(
        $db,
        "SELECT * FROM images",
        null
    )->fetchAll();

    $category_records = exec_sql_query(
        $db,
        "SELECT * FROM categories",
        null
    )->fetchAll();

    $diet_records = exec_sql_query(
        $db,
        "SELECT * FROM diets",
        null
    )->fetchAll();

    $categories = array("All");
    foreach ($category_records as $record) {
        $categories[] = $record["category"];
    }
    foreach ($diet_records as $record) {
        $categories[] = $record["diet"];
    }

    ?>

    <main id="gallery_main">
        <h2>Gallery</h2>

        <!-- All images in seed data are our own, taken for the purpose of using them in this project -->

        <?php if (isset($_GET["album"])) {
            $album_name = $_GET["album"];
            if (!in_array($album_name, $categories)) {
                echo "<h3>This album doesn't exist!</h3>";
            } else {
                echo "<h3>" . $album_name . "</h3>\n";
                if (array_search($album_name, $categories) == 0) {
                    // ALL
                    $sql = "SELECT images.id, images.image_ext, images.description, images.menu_id FROM images LEFT OUTER JOIN menu ON images.menu_id = menu.id";
                    $params = null;
                } else if (array_search($album_name, $categories) <= sizeof($category_records)) {
                    // MENU CATEGORY
                    $sql = "SELECT images.id, images.image_ext, images.description, images.menu_id from images INNER JOIN menu ON images.menu_id = menu.id INNER JOIN categories ON menu.category_id = categories.id WHERE categories.category = :category";
                    $params = array(
                        ':category' => $album_name
                    );
                } else {
                    // DIETARY RESTRICTION
                    $sql = "SELECT images.id, images.image_ext, images.description, images.menu_id from images LEFT OUTER JOIN menu ON images.menu_id = menu.id LEFT OUTER JOIN diet_tags ON menu.id = diet_tags.menu_id LEFT OUTER JOIN diets ON diet_tags.diet_id = diets.id WHERE diets.diet = :diet";
                    $params = array(
                        ':diet' => $album_name
                    );
                }
                $records = exec_sql_query($db, $sql, $params)->fetchAll();
            }
            ?>
            <div id="gallery_container">
                <?php
                for ($j = 0; $j < 4; $j++) {
                    echo "<div class='gallery_column'>";
                    for ($i = $j; $i < sizeof($records); $i += 4) {
                        $record = $records[$i];
                        if ($record["menu_id"] != "") {
                            $dishlinkop = "<a href = 'dish.php?id=" . $record["menu_id"] . "'>";
                            $dishlinked = "</a>";
                        } else {
                            $dishlinkop = "";
                            $dishlinked = "";
                        }
                        echo "
                        <div class='album_image'>" . $dishlinkop . "
                        <div class='album_image_container'>
                            <img class='album_image_file' src='uploads/" . $record["id"] . "." . $record["image_ext"] . "' alt=''>
                            <p class='album_image_desc'>" . $record["description"] . "</p>" . "
                            </div>" . $dishlinked;

                        if ($current_user != null) {
                            ?>
                            <form class="deleterform" action="delete.php" method="get">
                                <button name="deleter" value="<?php echo ($record["id"]); ?>" class='deleter' type="submit">Delete</button>
                            </form>
                        <?php }
                    echo "</div>";
                }
                echo "</div>\n";
            }
            ?>
            </div>
        <?php } else {

        ?>

            <div id="albums_container">
                <?php
                foreach ($categories as $category) {
                    if (array_search($category, $categories) == 0) {
                        // ALL
                        $sql = "SELECT images.id, images.image_ext FROM images INNER JOIN menu ON images.menu_id = menu.id LIMIT 1";
                        $params = null;
                    } else if (array_search($category, $categories) <= sizeof($category_records)) {
                        // MENU CATEGORY
                        $sql = "SELECT images.id, images.image_ext from images INNER JOIN menu ON images.menu_id = menu.id INNER JOIN categories ON menu.category_id = categories.id WHERE categories.category = :category LIMIT 1";
                        $params = array(
                            ':category' => $category
                        );
                    } else {
                        // DIETARY RESTRICTION
                        $sql = "SELECT images.id, images.image_ext from images LEFT OUTER JOIN menu ON images.menu_id = menu.id LEFT OUTER JOIN diet_tags ON menu.id = diet_tags.menu_id LEFT OUTER JOIN diets ON diet_tags.diet_id = diets.id WHERE diets.diet = :diet LIMIT 1";
                        $params = array(
                            ':diet' => $category
                        );
                    }
                    $records = exec_sql_query($db, $sql, $params)->fetchAll();
                    $record = $records[0];
                    echo "
                    <div class='album'>
                        <a href = 'gallery.php?album=" . rawurlencode($category) . "'>
                        <img class='album_cover' src='uploads/" . $record["id"] . "." . $record["image_ext"] . "' alt=''>
                        <p class='album_name'>" . $category . "</p></a>
                    </div>";
                }
                ?>
            </div>

        <?php } ?>

    </main>

    <?php include("includes/footer.php"); ?>

</body>

</html>
