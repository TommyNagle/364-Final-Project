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

// Get name form values
$input = $_GET['firstName'];
$input2 = $_GET['lastName'];

// Sanitize input
$fname = htmlspecialchars($input, ENT_QUOTES);
$lname = htmlspecialchars($input2, ENT_QUOTES);


// Select data from database based on form inputs
if ($lname == '*' && $fname == '*') {
    $stmt = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id");
    $stmt->execute();
    $playerResult = $stmt->get_result();

    $stmt2 = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id");
    $stmt2->execute();
    $historyResult = $stmt2->get_result();
} 
elseif($lname == '*') {
    $stmt = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id WHERE Player.player_first = ?");
    $stmt->bind_param("s", $fname);
    $stmt->execute();
    $playerResult = $stmt->get_result();

    $stmt2 = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id WHERE Player.player_first = ?");
    $stmt2->bind_param("s", $fname);
    $stmt->execute();
    $historyResult = $stmt->get_result();
}
elseif($fname == '*' ) {
    $stmt = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id WHERE Player.player_last = ?");
    $stmt->bind_param("s", $lname);
    $stmt->execute();
    $playerResult = $stmt->get_result();

    $stmt2 = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id WHERE Player.player_last = ?");
    $stmt2->bind_param("s", $lname);
    $stmt2->execute();
    $historyResult = $stmt2->get_result();
}
else {
    $stmt = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id WHERE Player.player_first = ? AND Player.player_last = ?");
    $stmt->bind_param("ss", $fname, $lname);
    $stmt->execute();
    $playerResult = $stmt->get_result();

    $stmt2 = $mysqli->prepare("SELECT * FROM Player JOIN History ON Player.player_id = History.player_id WHERE Player.player_first = ? AND Player.player_last = ?");
    $stmt2->bind_param("ss", $fname, $lname);
    $stmt2->execute();
    $historyResult = $stmt2->get_result();
}

$mysqli->close();
?>

<!-- HTML code to display data in tabular format -->
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
        <a class="active" href="player_search.html">Player Search</a>
        <a href="team_search.php">Team Search</a>
        <a href="rank.php">Statistic Summary</a>
        <a href="login.php">Admin Login</a>
    </nav> <br> <br>

    <main>
        <h2>Player Statistics</h2>
        <table>
            <tr>
                <th>NFL Rank</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Team</th>
                <th>Touchdowns</th>
                <th>Receiving Yardage</th>
                <th>Catches</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$playerResult->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['nfl_rank'];?></td>
                <td><?php echo $rows['player_first'];?></td>
                <td><?php echo $rows['player_last'];?></td>
                <td><?php echo $rows['team'];?></td>
                <td><?php echo $rows['touchdowns'];?></td>
                <td><?php echo $rows['receiving_yardage'];?></td>
                <td><?php echo $rows['catches'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>

        <h2>Player History (Career Total Statistics)</h2>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Career Total Touchdowns</th>
                <th>Career Total Receiving Yardage</th>
                <th>Career Total Catches</th>
                <th>Years Played in the NFL</th>
                <th>Previous NFL Team</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$historyResult->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['player_first'];?></td>
                <td><?php echo $rows['player_last'];?></td>
                <td><?php echo $rows['career_touchdowns'];?></td>
                <td><?php echo $rows['career_receiving_yardage'];?></td>
                <td><?php echo $rows['career_catches'];?></td>
                <td><?php echo $rows['years_played'];?></td>
                <td><?php echo $rows['previous_team'];?></td>
            </tr>
            <?php
                }
            ?>
        </table> <br>

        <button onclick="navigate()">Return to Player Search</button> <br>
    </main>

    <script>
        function navigate() {
            window.location.href = "player_search.html";
        }
    </script>
        
</body>
</html>