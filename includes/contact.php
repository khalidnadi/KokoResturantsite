<?php

$error = 'hidden';
$error2 = 'hidden';
$error3 = 'hidden';
$submiterror = 'hidden';
$name = '';
$email = '';
$response = '';
$reason = '';
$delivery = '';

if (isset($_POST['faqsubmit'])) {
  $faqresponse = filter_input(INPUT_POST, 'faq', FILTER_SANITIZE_STRING);
}

if (isset($_POST['contactsubmit'])) {
  $name = filter_input(INPUT_POST, 'order_name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
  $response = filter_input(INPUT_POST, 'response', FILTER_SANITIZE_STRING);
  $reason = filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING);
  $delivery = filter_input(INPUT_POST, 'delivery', FILTER_SANITIZE_STRING);
  $valid_order = true;
  if (strlen($email) < 5) {
    $error2 = 'TEST';
  }
  if (strlen($response) < 25) {
    $error3 = 'TEST';
  }
  if (strlen($name) == 0) {
    $valid_order = false;
    $error = 'TEST';
  } else {
    if (strlen($email) < 5) {
      $valid_order = false;
      $error2 = 'TEST';
    } else {
      if (strlen($response) < 25 || strlen($response) > 500) {
        $valid_order = false;
        $error3 = 'TEST';
      } else {
        $valid_order = true;
      }
    }
  }
  //add contact to database
  if ($valid_order) {
    $sql = "INSERT INTO contact (name, email, reason, text, delivery)
    VALUES (:name,:email, :reason, :text, :delivery)";
    $params = array(
      ':name' => $name,
      ':email' => $email,
      ':reason' => $reason,
      ':text' => $response,
      ':delivery' => $delivery
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      $review_id = $db->lastInsertId("id");
      // echo ("Contact Messege Successfully Submitted!");
      $submiterror = 'hidden';
    } else {
      $submiterror = '';
    }
  }
}
?>

<div id="content-wrap">
  <article id="content">

    <?php
    if (isset($valid_order) && $valid_order) {
      ?><div id='dfeedbacker'>
        <h3 class=submit>Thank you for your feedback. We will get back to you shortly, <?php echo $name; ?> </h3>
        <ul id='feedbacker'>
          <li> <a><strong>Name:</strong> <?php echo $name; ?></a></li>
          <li> <a><strong>Email:</strong> <?php echo $email; ?></a></li>
          <li> <a><strong>Reason for contact: </strong> <?php echo $reason; ?></a></li>
          <li> <a><strong>Delivery Option: </strong><?php echo $delivery; ?></a></li>
          <li> <a id="contact_form_response"><strong>Response: </strong><?php echo $response; ?></a></li>
        </ul>
      </div>
    <?php
  } else { ?>

      <h2>Frequently Asked Questions</h2>
      <form action="contact.php" id="faqform" method="post" name="faqform">
        <div class='question'>
          <label for="faq"></label>
          <select id="faq" name="faq">
            <option value="hours" <?php if ($faqresponse == "hours") echo "selected"; ?>>
              What are the store hours?
            </option>
            <option value="adress" <?php if ($faqresponse == "adress") echo "selected"; ?>>
              What is the store address?
            </option>
            <option value="options" <?php if ($faqresponse == "options") echo "selected"; ?>>
              What delivery options are offered?
            </option>
          </select>
          <input type="submit" name="faqsubmit" id='faqsubmit' value="ANSWER" />
        </div>
      </form>

      <?php

      if (isset($_POST['faqsubmit'])) {
        // $faqresponse = filter_input(INPUT_POST, 'faq', FILTER_SANITIZE_STRING);
        if ($faqresponse == "hours") {
          ?>
          <fieldset class='hours'>
            <legend>Store Hours</legend>
            <ul id='storehours'>
              <li>Sunday 11:30AM–9:00PM</li>
              <li>Monday 11:30AM–9:00PM</li>
              <li>Tuesday Closed</li>
              <li>Wednesday 11:30AM–9:00PM</li>
              <li>Thursday 11:30AM–9:00PM</li>
              <li>Friday 11:30AM–9:00PM</li>
              <li>Saturday 11:30AM–9:00PM</li>
            </ul>
          </fieldset>
        <?php

      }
      if ($faqresponse == "options") {
        ?>
          <fieldset class='options'>
            <legend>Delivery Options</legend>
            <ul>
              <li><a href="https://www.ithacatogo.com/r/1712/restaurants/delivery/Korean/Koko-Ithaca" target="_blank">Ithaca To Go</a></li>
              <li><a href="https://www.deliverithaca.com/" target="_blank">Deliver Ithaca</a></li>
              <li><a href="https://www.grubhub.com/delivery/ny-ithaca" target="_blank">Grubhub</a></li>
            </ul>
          </fieldset>
        <?php

      }
      if ($faqresponse == "adress") {

        ?>
          <fieldset class='adress'>
            <legend>Address</legend>
            321 College Ave, Ithaca, NY 14850
          </fieldset>
        <?php

      }
    }
    ?>
      <h2>Please leave your feedback here:</h2>
      <form id="contact_order" method="post" action="contact.php">
        <fieldset class="review">
          <legend>Contact us Form</legend>
          <p>Please leave us a message here between 25 and 500 characters.</p>

          <p class="form_error2 <?php echo $submiterror; ?>" id="formerror">Errors have prevented your form from submission</p>
          <p class="form_error <?php echo $error; ?>" id="nameError">Please provide a name for your response: </p>
          <div class="namecontain">
            <label for="name_field">Name on Order:</label>
            <input id="name_field" type="text" name="order_name" value="<?php echo htmlspecialchars($name); ?>" />
          </div>
          <p class="form_error2 <?php echo $error2; ?>" id="nameError2">Please provide a valid email for your order in the form example@example.___:</p>
          <div class="emailcontainer">
            <label for="emailfield">Email:</label>
            <input id="emailfield" type="text" name="userEmail" value="<?php echo htmlspecialchars($email); ?>" />
          </div>
          <div>
            <label for="reason">Please select your reason of Contact:</label> <select id="reason" name="reason">
              <option value="RequestInformation" <?php if ($reason == "RequestInformation") echo "selected"; ?>>
                Request More Information
              </option>
              <option value="Reservation" <?php if ($reason == "Reservation") echo "selected"; ?>>
                Make a reservation
              </option>
              <option value="Feedback" <?php if ($reason == "Feedback") echo "selected"; ?>>
                Provide feedback or Get Help
              </option>
              <option value="Other" <?php if ($reason == "Other") echo "selected"; ?>>
                Other
              </option>
            </select>
          </div>
          <div>
            <label for="delivery">Delivery Method:</label> <select id="delivery" name="delivery">
              <option value="IthacaToGo" <?php if ($delivery == "IthacaToGo") echo "selected"; ?>>
                Ithaca To Go
              </option>
              <option value="DeliverIthaca" <?php if ($delivery == "DeliverIthaca") echo "selected"; ?>>
                Deliver Ithaca
              </option>
              <option value="GrubHub" <?php if ($delivery == "GrubHub") echo "selected"; ?>>
                Grubhub
              </option>
              <option value="Pickup" <?php if ($delivery == "Pickup") echo "selected"; ?>>
                Pick Up From Store
              </option>
            </select>
          </div>
          <p class="form_error3 <?php echo $error3; ?>" id="responseError">Your response did not meet the character requirement:</p>
          <div>
            <label for="response">Please share your thoughts here:</label>
            <div>
              <textarea id="response" name="response" value=" ?>"><?php echo htmlspecialchars($response); ?>   </textarea>
            </div>
          </div>
          <input type="submit" name="contactsubmit" id='contactsubmit' value="ASK" />
        </fieldset>
      </form>

    <?php
  } ?>

  </article>
</div>
