<!-- PHP code to establish connection with the localserver -->
<?php

$user = 'student';
$password = 'CompSci364';
$database = 'student';
$servername='localhost';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}

$input = $_POST['new_password'];
$new_password = htmlspecialchars($input, ENT_QUOTES);

// Hash new password
$hash = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "UPDATE Admin SET password_hash=? WHERE username='admin'";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $hash);
    
if ($stmt->execute()) {
    echo "<span style='color: red;'>Password updated successfully.</span>";
}
else {
    echo "<span style='color: red;'>Error updating password. Please try again.</span>";
}

$mysqli->close;
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

        
        <div class = "edit">
            <button onclick="navigate()">Edit Database</button><br>
        </div>
        
    </main>

    <script>
        function navigate() {
            window.location.href = "login.php";
        }
    </script>
        
</body>
</html>