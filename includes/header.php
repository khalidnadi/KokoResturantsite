  <header>
    <div id="logo">
      <!-- Image Created by Jinju Ouck -->
      <a href="index.php"><img alt="KoKo Logo" src="images/kokotemplogo.png" /></a>
    </div>
    <nav id="navmenu">
      <ul>
        <?php
        $nav = array('index.php' => 'Home', 'about.php' => 'About', 'menu.php' => 'Menu', 'gallery.php' => 'Gallery',  'reviews.php' => 'Reviews');
        if ($current_user != null) {
          $nav['upload_image.php'] = 'Upload Image';
          $nav['employee.php'] = 'Responses';
        } else {
          $nav['contact.php'] = 'Contact';
          $nav['employee.php'] = 'Login';
        }

        $current = basename($_SERVER['PHP_SELF']);

        foreach ($nav as $pagename => $value) {
          if ($current == $pagename) {
            echo "<li>" . " <a  class = current_page href=" . $pagename . "> " . $value . "</a></li>";
          } else {
            echo "<li class>" . " <a href=" . $pagename . "> " . $value . "</a></li>";
          }
        }
        // Log Out link
        if ($current_user != null) {
          // Add a logout query string parameter
          $logout_url = htmlspecialchars($_SERVER['PHP_SELF']) . '?' . http_build_query(array('logout' => ''));

          echo '<li class =logout_but id="logout_but"><a href="' . $logout_url . '">Sign Out ' . htmlspecialchars($current_user['username']) . '</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>
