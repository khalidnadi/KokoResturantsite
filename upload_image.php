<?php

include("includes/init.php");
$db = open_or_init_sqlite_db('secure/site.sqlite', 'secure/init.sql');
$title = "add";
$index = "current";
$messages = array();

if (isset($_POST['upload_submit'])) {
    $validform = true;
    $file_info = $_FILES["image_file"];
    $file_menu_id = filter_input(INPUT_POST, 'menu_id', FILTER_SANITIZE_NUMBER_INT);
    $file_description = filter_input(INPUT_POST, 'image_desc', FILTER_SANITIZE_STRING);
    $file_source = filter_input(INPUT_POST, 'image_source', FILTER_SANITIZE_STRING);
    if ($file_description == "") {
        array_push($messages, "You must write a description for the image.");
        $validform = false;
    }
    if ($file_source == "") {
        array_push($messages, "You must specify the source of the image.");
        $validform = false;
    }

    if ($validform && $file_info['error'] == UPLOAD_ERR_OK) {
        $file_name = basename($file_info["name"]);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $sql = "INSERT INTO images
      (menu_id, image_name, image_ext, description, source) VALUES (:menu_id,:image_name,:image_ext,:description,:source);";
        $params = array(
            ':menu_id' => $file_menu_id,
            ':image_name' => $file_name,
            ':image_ext' => $file_ext,
            ':description' => $file_description,
            ':source' => $file_source
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
            $file_id = $db->lastInsertId("id");
            $id_filename = 'uploads/' . $file_id . '.' . $file_ext;
            if (move_uploaded_file($file_info["tmp_name"], $id_filename)) {
                array_push($messages, "Upload Successful!");
            } else {
                array_push($messages, "Upload failed.");
            }
        } else {
            array_push($messages, "Upload failed.");
        }
    } else {
        array_push($messages, "Upload failed.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

    <title>Upload Image</title>
</head>

<body>

    <?php include("includes/header.php"); ?>

    <main id="upload_main">

        <h2>Upload to Gallery</h2>
        <?php
        if ($current_user == null) {
            echo "<p class='upload_alert'> Unauthorized Access </p>";
        } else {
            foreach ($messages as $message) {
                echo "<p class='upload_alert'><strong>" . htmlspecialchars($message) . "</strong></p>\n";
            }

            $sql = "SELECT * FROM menu";
            $menu_records = exec_sql_query($db, $sql, null)->fetchAll();
            ?>
            <form id="upload" action="upload_image.php" method="post" enctype="multipart/form-data">
                <ul>
                    <li>
                        <label for="menu_id">Menu:</label>
                        <!-- <input type="number" id="menu_id" name="menu_id" min="1" value="<?php
                                                                                                ?>" /> -->
                        <!-- TODO: STICKY FORM? value = ""-->
                        <select name="menu_id" id="menu_id">
                            <?php
                            foreach ($menu_records as $menu_record) {
                                if ($file_menu_id == $menu_record["id"])
                                    echo "<option value=" . $menu_record["id"] . " selected>" . $menu_record["menu_name"] . "</option>";
                                else
                                    echo "<option value=" . $menu_record["id"] . ">" . $menu_record["menu_name"] . "</option>";
                            }
                            ?>
                        </select>
                    </li>
                    <li>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 2000000; ?>" />

                        <label for="image_file">Upload File:</label>
                        <input id="image_file" type="file" name="image_file">
                    </li>
                    <li>
                        <label for="image_source">Source:</label>
                        <input id="image_source" name="image_source" type="text" value='<?php echo $file_source; ?>' />
                    </li>
                    <li>
                        <label for="image_desc">Description:</label>
                        <textarea id="image_desc" name="image_desc"><?php echo $file_description; ?></textarea>
                    </li>
                    <li>
                        <input id="uploadButton" name="upload_submit" type="submit" value="Add Image">
                    </li>
                </ul>
            </form>
        <?php } ?>
    </main>
    <?php include("includes/footer.php"); ?>
</body>


</html>
