<?php
session_start(); // start (or resume) session

// create database connection ($connection)
$connection = new mysqli("localhost", "student", "CompSci364",
                         "student");

$error = false;
if (! isset($_SESSION["username"]) // already authenticated
    && isset($_POST["username"], $_POST["password"])) {
  // query database for account information
  $statement = $connection->prepare("SELECT password_hash ".
                                    "FROM Admin ".
                                    "WHERE username = ?;");
  $statement->bind_param("s", $_POST["username"]);

  $statement->execute();
  $statement->bind_result($password_hash);

  // username present in database
  if ($statement->fetch()) {
    // verify that the password matches stored password hash
    if (password_verify($_POST["password"], $password_hash)) {
      // store the username to indicate authentication
      $_SESSION["username"] = $_POST["username"];
    }
  }

  $error = true;
}

if (isset($_SESSION["username"])) { // authenticated

  $location = "change_password.html";

  // redirect to requested page
  header("Location: ".$location);
}
?>

<!doctype html>
<html lang="en-US">

<head>
    <title>NFL Database</title>
    <link href="nfl_css_sheet.css" rel="stylesheet"/>
</head>

<body>

    <header>
        <img src="nfl_logo.jpg" alt="Logo" />
        <h1>statistics</h1>
    </header>

    <nav class="navbar">
        <a href="index.html">Introduction</a>
        <a href="player_search.html">Player Search</a>
        <a href="team_search.php">Team Search</a>
        <a href="rank.php">Statistic Summary</a>
        <a class="active" href="login.php">Admin Login</a>
    </nav> <br> <br>

    <main>

        <h2>Login to change password</h2>
        <form action="<?php echo $_SERVER["PHP_SELF"].
                                "?".$_SERVER["QUERY_STRING"]; ?>"
            method="post">
        <label for="username">Username</label><br>
        <input name="username" type="text"
                value="<?php if (isset($_POST["username"]))
                                echo $_POST["username"]; ?>" /><br>
        <label for="password">Current Password</label>
        <input name="password" type="password" /><br>

        <input type="submit" value="Log in" /> <br>

        <?php
          if ($error) {
            echo "<span style='color: red;'>Invalid username or password.</span>";
          }
        ?>
        </form> <br>
        
    </main>
        
</body>
</html>