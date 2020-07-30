    <!-- Show Contact Submissions -->
    <fieldset class='contactsubmiss'>
        <?php
        $sql = "SELECT * FROM contact";
        $params = array();
        $result = exec_sql_query($db, $sql, $params);
        $records = $result->fetchAll();
        foreach ($records as $record) {
            $deleterkey = '\'deleter' . ' ' . $record['id'] . '\'';
            if (isset($_GET[$deleterkey])) {
                echo ("Contact issue successfully deleted from entries.");
            }
            if (isset($_GET["deleter"])) {
                //DELETE CCONTACT RESPONSE
                $sql = "SELECT * FROM contact WHERE id = :id;";
                $params = array(
                    ':id' => $_GET["deleter"]
                );
                $records = exec_sql_query($db, $sql, $params)->fetchAll();
                if ($records) {
                    foreach ($records as $record) {
                        $sql = "DELETE FROM contact WHERE id = :id;";
                        $params = array(
                            ':id' => $record["id"]
                        );
                        $records = exec_sql_query($db, $sql, $params);
                        if ($records) {
                            header("Refresh:0");
                        } else {
                            echo "<h2 class='delete_alert'> Failed to delete Contact Submission </h2>";
                        }
                    }
                }
            }
            ?>
            <div class="display_contact">
                <!--Each table column is echoed into a td cell-->
                <div class="inner_display_contactl">
                    <p><strong><?php echo htmlspecialchars($record['name']); ?></strong></p>
                    <p><?php echo htmlspecialchars($record['email']); ?></p>
                    <p><?php echo htmlspecialchars($record['reason']); ?></p>
                    <p><?php echo htmlspecialchars($record['delivery']); ?></p>
                </div>
                <div class="inner_display_contactr">
                    <p>
                        <p><?php echo htmlspecialchars($record['review_title']); ?></p>
                        <p><?php echo htmlspecialchars($record['text']); ?></p>
                </div>
                <div>
                    <form action="employee.php" method="get">
                        <button name="deleter" class='deleter2' value="<?php echo ($record["id"]); ?>" type="submit">Delete</button>
                        <?php

                        ?>

                    </form>
                </div>
            </div>
        <?php
    } ?>
    </fieldset>
