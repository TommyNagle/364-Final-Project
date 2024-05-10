<!-- PHP code to establish connection with the localserver -->
<?php
 
$user = 'student';
$password = 'CompSci364';
$database = 'student';
$servername='localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$stmt = $mysqli->prepare("SELECT name FROM Team");
$stmt->execute();
$result = $stmt->get_result();

$mysqli->close();
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
        <a class="active" href="team_search.php">Team Search</a>
        <a href="rank.php">Statistic Summary</a>
        <a href="login.php">Admin Login</a>
    </nav> <br> <br>

    <main>
        <h2>Search for an NFL Team</h2>
        <div class="categories">
            <form action="team_display.php" method="get">
                <select name="filter" id="filter">
                    <?php 
                        // loop through teams and fill dropbox
                        while($rows=$result->fetch_assoc())
                        {
                            echo "<option value='" . $rows['name'] . "'>" . $rows['name'] . "</option>";
                        }
                    ?>
                </select>
                <button type="submit">Search</button> <br>
            </form> 
        </div>

    </main>
        
</body>
</html>