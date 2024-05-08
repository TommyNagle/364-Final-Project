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

// Perform insert based on selected table
if (strcmp($_POST['filter'], "insert_player.html") == 0) {
    $table = "Player";
    $player_id = $_POST['player_id'];
    $nfl_rank = $_POST['nfl_rank'];
    $player_last = $_POST['player_last'];
    $player_first = $_POST['player_first'];
    $team = $_POST['team'];
    $touchdowns = $_POST['touchdowns'];
    $receiving_yardage = $_POST['receiving_yardage'];
    $catches = $_POST['catches'];

    // Perform insert operation
    $checkstmt = $mysqli->prepare("SELECT * FROM $table WHERE player_id=?");
    $checkstmt->bind_param("i", $player_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if player_id that was entered already exists
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO $table (player_id, nfl_rank, player_last, player_first, team, touchdowns, receiving_yardage, catches)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iisssiii", $player_id, $nfl_rank, $player_last, $player_first, $team, $touchdowns, $receiving_yardage, $catches);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>New record inserted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error entering entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Attempted duplicate player_id entry.</span>";
    }
}
elseif (strcmp($_POST['filter'], "insert_team.html") == 0) {
    $table = "Team";
    $name = $_POST['name'];
    $year_founded = $_POST['year_founded'];
    $num_wins = $_POST['num_wins'];
    $num_widereceivers = $_POST['num_widereceivers'];

    // Perform insert operation
    $checkstmt = $mysqli->prepare("SELECT * FROM $table WHERE name=?");
    $checkstmt->bind_param("s", $name);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if team name that was entered already exists
    if ($result->num_rows == 0) {
        $sql = "INSERT INTO $table (name, year_founded, num_wins, num_widereceivers)
        VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("siii", '$name', $year_founded, $num_wins, $num_widereceivers);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>New record inserted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error entering entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Attempted duplicate team name entry.</span>";
    }
}
elseif (strcmp($_POST['filter'], "insert_history.html") == 0) {
    $table = "History";
    $player_id = $_POST['player_id'];
    $career_touchdowns = $_POST['career_touchdowns'];
    $career_receiving_yardage = $_POST['career_receiving_yardage'];
    $career_catches = $_POST['career_catches'];
    $years_played = $_POST['years_played'];
    $current_team = $_POST['current_team'];
    $previous_team = $_POST['previous_team'];

    // Perform insert operation
    $checkstmt = $mysqli->prepare("SELECT * FROM Player WHERE player_id=?");
    $checkstmt->bind_param("i", $player_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    $checkstmt2 = $mysqli->prepare("SELECT * FROM Team WHERE name=?");
    $checkstmt2->bind_param("s", $current_team);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    $checkstmt3 = $mysqli->prepare("SELECT * FROM History WHERE player_id=?");
    $checkstmt3->bind_param("i", $player_id);
    $checkstmt3->execute();
    $result3 = $checkstmt3->get_result();

    // Check if player_id and team name that was entered exists in database, and there is no duplicate history player_id
    if ($result->num_rows > 0 && $result2->num_rows > 0 && $result3->num_rows == 0) {
        $sql = "INSERT INTO $table (player_id, career_touchdowns, career_receiving_yardage, career_catches, years_played, current_team, previous_team)
        VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iiiiiss", $player_id, $career_touchdowns, $career_receiving_yardage, $career_catches, $years_played, '$current_team', '$previous_team');

        if ($stmt->execute()) {
            echo "<span style='color: red;'>New record inserted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error entering entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Player ID and/or team name does not exist in database. Make new entry in Player and Team table first.</span>";
    }
}
elseif (strcmp($_POST['filter'], "insert_coach.html") == 0) {
    $table = "Coach";
    $coach_id = $_POST['coach_id'];
    $team = $_POST['team'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Perform insert operation
    $checkstmt = $mysqli->prepare("SELECT * FROM Team WHERE name=?");
    $checkstmt->bind_param("s", $team);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    $checkstmt2 = $mysqli->prepare("SELECT * FROM Coach WHERE coach_id=?");
    $checkstmt2->bind_param("i", $coach_id);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    // Check if team name that was entered exists and that there is no duplicate coach_id
    if ($result->num_rows > 0 && $result2->num_rows == 0) {
        $sql = "INSERT INTO $table (coach_id, team, first_name, last_name)
        VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iiiiiss", $player_id, $career_touchdowns, $career_receiving_yardage, $career_catches, $years_played, '$current_team', '$previous_team');

        if ($stmt->execute()) {
            echo "<span style='color: red;'>New record inserted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error entering entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Team name does not exist in database. Make new entry in Team table first.</span>";
    }
}
elseif (strcmp($_POST['filter'], "insert_experience.html") == 0) {
    $table = "Experience";
    $coach_id = $_POST['coach_id'];
    $team = $_POST['team'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $years_coached = $_POST['years_coached'];
    $coach_type = $_POST['coach_type'];

    // Perform insert operation
    $checkstmt = $mysqli->prepare("SELECT * FROM Coach WHERE coach_id=?");
    $checkstmt->bind_param("i", $coach_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    $checkstmt2 = $mysqli->prepare("SELECT * FROM Experience WHERE coach_id=?");
    $checkstmt2->bind_param("i", $coach_id);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    // Check if coach ID that was entered exists and that there is no duplicate experience coach_id
    if ($result->num_rows > 0 && $result2->num_rows == 0) {
        $sql = "INSERT INTO $table (coach_id, team, first_name, last_name, years_coached, coach_type)
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("isssis", $coach_id, '$team', '$first_name', '$last_name', $years_coached, '$coach_type', '$previous_team');

        if ($stmt->execute()) {
            echo "<span style='color: red;'>New record inserted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error entering entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Coach ID does not exist in database. Make new entry in Coach table first.</span>";
    }
}



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
        <a href="team_search.php">Team Search</a>
        <a href="rank.php">Statistic Summary</a>
        <a class="active" href="login.php">Admin Login</a>
    </nav> <br> <br>

    <main>

        <button onclick="navigate()">Edit another Database Entry</button> <br>

        <form style="background-color: black" action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
        
    </main>

    <script>
        function navigate() {
            window.location.href = "select_op.php";
        }
    </script>
        
</body>
</html>