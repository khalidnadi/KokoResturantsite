<?php
// vvv DO NOT MODIFY/REMOVE vvv

// check current php version to ensure it meets 2300's requirements
function check_php_version()
{
  if (version_compare(phpversion(), '7.0', '<')) {
    define(VERSION_MESSAGE, "PHP version 7.0 or higher is required for 2300. Make sure you have installed PHP 7 on your computer and have set the correct PHP path in VS Code.");
    echo VERSION_MESSAGE;
    throw VERSION_MESSAGE;
  }
}
check_php_version();

function config_php_errors()
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 0);
  error_reporting(E_ALL);
}
config_php_errors();

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename)
{
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (file_exists($init_sql_filename)) {
      $db_init_sql = file_get_contents($init_sql_filename);
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    } else {
      unlink($db_filename);
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return null;
}

function exec_sql_query($db, $sql, $params = array())
{
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return null;
}

// ^^^ DO NOT MODIFY/REMOVE ^^^
// You may place any of your code here.
/* Source: Code adapted from Lab 8 init */
$loginerror = 'hidden';
$db = open_or_init_sqlite_db("secure/site.sqlite", "secure/init.sql");
function open_sqlite_db($db_filename)
{
  $db2 = new PDO('sqlite:' . $db_filename);
  $db2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db2;
}

function user_exists($username)
{
  global $db;

  $sql = "SELECT * FROM users WHERE username = :username;";
  $params = array(
    ':username' => $username
  );
  $records = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($records) {
    // users are unique, there should only be 1 record
    return $records[0];
  }
  return NULL;
}
define('SESSION_COOKIE_DURATION', 60 * 60 * 1); // 1 hour = 60 sec * 60 min * 1 hr
$session_messages = array(); //REQUIRES FI
// $messeges2 = "null";
$showMessege = false;
function log_in($username, $password)
{ }

function find_user($user_id)
{
  global $db;

  $sql = "SELECT * FROM users WHERE id = :user_id;";
  $params = array(
    ':user_id' => $user_id
  );
  $records = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($records) {
    // users are unique, there should only be 1 record
    return $records[0];
  }
  return NULL;
}

function find_COOKIE($session)
{
  global $db;

  if (isset($session)) {
    $sql = "SELECT * FROM sessions WHERE session = :session;";
    $params = array(
      ':session' => $session
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // sessions are unique, so there should only be 1 record
      return $records[0];
    }
  }
  return NULL;
}

function session_login()
{
  global $db;
  global $current_user;

  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];

    $session_record = find_COOKIE($session);

    if (isset($session_record)) {
      $current_user = find_user($session_record['user_id']);

      // Renew the cookie for 1 more hour
      setcookie("session", $session, time() + SESSION_COOKIE_DURATION);

      return $current_user;
    }
  }
  $current_user = NULL;
  return NULL;
}

function log_out()
{
  global $current_user;

  // Remove the session from the cookie and force it to expire (go back in time).
  setcookie('session', '', time() - SESSION_COOKIE_DURATION);
  $current_user = NULL;
}
function insert_COOKIE($user_id, $account, $session)
{
  global $db;

  $sql = "INSERT INTO sessions (user_id, session) VALUES (:user_id, :session);";
  $params = array(
    ':user_id' => $account,
    ':session' => $session
  );
  $result = exec_sql_query($db, $sql, $params)->fetchAll();
  return $result;
}

// Log in user if clicks login
if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);


  global $db;
  global $current_user;
  // global $session_messages;
  global $messeges2;

  if (!isset($username)) {
    $messages2 = "No username or password given";
    $showMessege = false;
    echo (htmlspecialchars("No UNAME Given"));
  }

  if (!isset($password)) {
    $messages2 = "No username or password given";
    $showMessege = false;
    echo (htmlspecialchars("No Password Given"));
  }
  // Does this username even exist in our database?
  $account = user_exists($username);
  if (!is_null($account)) {
    // Username is UNIQUE, so there should only be 1 record.
    // $account = $records[0];

    // Check password against hash in DB
    if (password_verify($password, $account['password'])) {
      // Generate session
      $session = session_create_id(null);

      // Store session ID in database
      $sql = "INSERT INTO sessions (user_id, session) VALUES (:user_id, :session);";
      $params = array(
        ':user_id' => $account['id'],
        ':session' => $session
      );
      $result = exec_sql_query($db, $sql, $params);
      // insert_COOKIE($userid, $account['id'], $session)

      if ($result) {
        // session stored in DB


        setcookie("session", $session, time() + SESSION_COOKIE_DURATION);

        $current_user = $account;
        $loginerror = 'hidden';
        return $current_user;
      } else {
        $messages = "Log in failed";
        $showMessege = false;
        echo (htmlspecialchars("Log in Failed"));
      }
    } else {
      $messages2 = "Invalid username or password";
      $showMessege = false;
      $loginerror='';
      // echo (htmlspecialchars("nvalid username or pass"));
    }
  } else {
    $messages2 = "Invalid username or password";
    // echo (htmlspecialchars("nvalid username or pass"));
    $loginerror = '';
    $showMessege = false;
  }

  $current_user = NULL;
  return NULL;
} else {
  // check if logged in already via cookie
  session_login();
}

// Check if we should logout the user
if (isset($current_user) && (isset($_GET['logout']) || isset($_POST['logout']))) {
  global $current_user;
  setcookie('session', '', time() - SESSION_COOKIE_DURATION);
  $current_user = NULL;
}
