<?php
include("includes/init.php");

$title = "about";
$index = "current";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

    <title>About</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <main id="about_main">
        <h2>About</h2>
        <!-- include some images of Koko -->
        <div class="about_section">
            <h3 class="about_header">Koko</h3>
            <p class="about_info">
                For over 10 years, Koko Korean Restaurant has been one of the most popular eateries in Collegetown. We strive to serve only the best food with the freshest, high-quality ingredients to not only provide comfort food for Korean students away from home, but also to introduce Korean cuisine to people of all backgrounds. We offer a variety of Korean foods, from spicy classic stews to refreshing cold summer noodles, and offer options for all dietary needs.
            </p>
        </div>

        <div class="about_section">
            <h3 class="about_header">Korean Cuisine</h3>
            <p class="about_info">
                Korean cuisine developed over the centuries of Korean history, including royal court cousines from a few centuries ago to street food only a few years old. For a lot of Korean dishes, rice always accompanies the meal. It may sometimes be replaced with noodles, but rice and soup are usually the basics of Korean meals. Side dishes also often accompany a typical Korean meal, including kimchi, vegetables called Namul, etc. Some of the characteristics of Korean cuisine that stand out are the spiciness and the hot temperature, but there are dishes that have sweet or light taste as well. Common ingredients that go into Korean dishes include sesame oil, pepper paste (gochujang), soybean paste (daenjang), soy sauce, garlic, scallions, etc.
                For more information about Korean cuisine, please see <a href="https://en.wikipedia.org/wiki/Korean_cuisine" target="_blank">this website</a>.
            </p>
        </div>

    </main>

    <?php include("includes/footer.php"); ?>

</body>

</html>
