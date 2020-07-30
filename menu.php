<?php
include("includes/init.php");

$title = "menu";
$index = "current";

$db = open_or_init_sqlite_db('secure/site.sqlite', 'secure/init.sql');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="styles/all.css" media="all" rel="stylesheet" type="text/css">
    <title>Menu</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <main id="menu_main">
        <h2>Menu</h2>

        <form id="diet_filter_form" method="get" action="menu.php">
            <h3 id="diet_filter_header">Filter by diet:</h3>
            <select name="diet_select" id="diet_select">
                <option value="all">All</option>
                <?php
                $sql = 'SELECT * FROM diets;';
                $params = array();
                $diets = exec_sql_query($db, $sql, $params);
                foreach ($diets as $diet) {
                    ?>
                    <option value=<?php echo htmlspecialchars($diet["diet"]) ?>>
                        <?php echo htmlspecialchars($diet["diet"]) ?>
                    </option>
                <?php
            }
            ?>
            </select>
            <button name="diet_filter">Filter</button>
        </form>

        <div id="menu">
            <?php
            $sql = "SELECT * FROM categories;";
            $params = array();
            $categories = exec_sql_query($db, $sql, $params)->fetchAll();
            if (isset($_GET["diet_filter"])) {
                $filter = $_GET["diet_select"];
                if ($filter == "all") {
                    foreach ($categories as $category) {
                        ?>
                        <h3 class="category_header"><?php echo htmlspecialchars($category["category"]) ?></h3>
                        <div class="menu_category">
                            <?php
                            $sql = "SELECT id, menu_name, description FROM menu WHERE category_id = :cat;";
                            $params = array(
                                ':cat' => $category["id"]
                            );
                            $menus = exec_sql_query($db, $sql, $params)->fetchAll();
                            foreach ($menus as $menu) {
                                ?>
                                <div class="menu_item">
                                    <a href="<?php echo "dish.php?" . http_build_query(array('id' => $menu['id'])) ?>" class="menu_name">
                                        <h4><?php echo htmlspecialchars($menu["menu_name"]) ?></h4>
                                    </a>
                                    <p class="menu_description">
                                        <?php echo htmlspecialchars($menu["description"]) ?>
                                    </p>
                                </div>
                            <?php
                        }
                        ?>
                        </div>
                    <?php
                }
            } else {
                foreach ($categories as $category) {
                    ?>
                        <?php
                        $sql = "SELECT menu.id, menu_name, description FROM menu INNER JOIN diet_tags ON menu.id = diet_tags.menu_id INNER JOIN diets ON diet_tags.diet_id = diets.id WHERE menu.category_id = :cat AND diets.diet = :diet;";
                        $params = array(
                            ':cat' => $category["id"],
                            ':diet' => $filter
                        );
                        $menus = exec_sql_query($db, $sql, $params)->fetchAll();
                        if (count($menus) != 0) {
                            ?>
                            <h3 class="category_header"><?php echo htmlspecialchars($category["category"]) ?></h3>
                            <div class="menu_category">
                                <?php
                                foreach ($menus as $menu) {
                                    ?>
                                    <div class="menu_item">
                                        <a href="<?php echo "dish.php?" . http_build_query(array('id' => $menu['id'])) ?>" class="menu_name">
                                            <h4><?php echo htmlspecialchars($menu["menu_name"]) ?></h4>
                                        </a>
                                        <p class="menu_description">
                                            <?php echo htmlspecialchars($menu["description"]) ?>
                                        </p>
                                    </div>
                                <?php
                            }
                        }
                        ?>
                        </div>
                    <?php
                }
            }
        } else {
            foreach ($categories as $category) {
                ?>
                    <h3 class="category_header"><?php echo htmlspecialchars($category["category"]) ?></h3>
                    <div class="menu_category">
                        <?php
                        $sql = "SELECT id, menu_name, description FROM menu WHERE category_id = :cat;";
                        $params = array(
                            ':cat' => $category["id"]
                        );
                        $menus = exec_sql_query($db, $sql, $params)->fetchAll();
                        foreach ($menus as $menu) {
                            ?>
                            <div class="menu_item">
                                <a href="<?php echo "dish.php?" . http_build_query(array('id' => $menu['id'])) ?>" class="menu_name">
                                    <h4><?php echo htmlspecialchars($menu["menu_name"]) ?></h4>
                                </a>
                                <p class="menu_description">
                                    <?php echo htmlspecialchars($menu["description"]) ?>
                                </p>
                            </div>
                        <?php
                    }
                    ?>
                    </div>
                <?php
            }
        }
        ?>

        </div>


    </main>

    <?php include("includes/footer.php"); ?>

</body>

</html>
