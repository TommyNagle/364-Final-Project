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

// Perform update based on selected table
if (strcmp($_POST['filter'], "update_player.html") == 0) {
    $table = "Player";
    $player_id = $_POST['player_id'];
    $nfl_rank = $_POST['nfl_rank'];
    $player_last = $_POST['player_last'];
    $player_first = $_POST['player_first'];
    $team = $_POST['team'];
    $touchdowns = $_POST['touchdowns'];
    $receiving_yardage = $_POST['receiving_yardage'];
    $catches = $_POST['catches'];

    // Perform update operation
    $checkstmt = $mysqli->prepare("SELECT * FROM $table WHERE player_id=?");
    $checkstmt->bind_param("i", $player_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if player_id exists in database
    if ($result->num_rows > 0) {
        // Update data for boxes that are not null
        if ($nfl_rank != NULL) {
            $sql = "UPDATE $table SET nfl_rank = ? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $nfl_rank, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($player_last != "") {
            $sql = "UPDATE $table SET player_last = ? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $player_last, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($player_first != "") {
            $sql = "UPDATE $table SET player_first=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $playerfirst, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($team != "") {
            $sql = "UPDATE $table SET team = ? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $team, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($touchdowns != NULL) {
            $sql = "UPDATE $table SET touchdowns = ? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $touchdowns, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($receiving_yardage != NULL) {
            $sql = "UPDATE $table SET receiving_yardage = ? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $receiving_yardage, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($catches != NULL) {
            $sql = "UPDATE $table SET catches = ? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $catches, $player_id);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }
        
    }
    else {
        echo "<span style='color: red;'>Error: Player ID does not currently exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "update_team.html") == 0) {
    $table = "Team";
    $name = $_POST['name'];
    $year_founded = $_POST['year_founded'];
    $num_wins = $_POST['num_wins'];
    $num_widereceivers = $_POST['num_widereceivers'];

    // Perform update operation
    $checkstmt = $mysqli->prepare("SELECT * FROM $table WHERE name=?");
    $checkstmt->bind_param("s", $name);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if team name that was entered exists
    if ($result->num_rows > 0) {
        if ($year_founded != NULL) {
            $sql = "UPDATE $table SET year_founded=? WHERE name=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $year_founded, $name);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }
        if ($num_wins != NULL) {
            $sql = "UPDATE $table SET num_wins=? WHERE name=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $num_wins, $name);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }
        if ($num_widereceivers != NULL) {
            $sql = "UPDATE $table SET num_widereceivers=? WHERE name=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("is", $num_widereceivers, $name);

            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }
    }
    else {
        echo "<span style='color: red;'>Error: Team name does not currently exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "update_history.html") == 0) {
    $table = "History";
    $player_id = $_POST['player_id'];
    $career_touchdowns = $_POST['career_touchdowns'];
    $career_receiving_yardage = $_POST['career_receiving_yardage'];
    $career_catches = $_POST['career_catches'];
    $years_played = $_POST['years_played'];
    $current_team = $_POST['current_team'];
    $previous_team = $_POST['previous_team'];

    // Perform update operation
    $checkstmt = $mysqli->prepare("SELECT * FROM Player WHERE player_id=?");
    $checkstmt->bind_param("i", $player_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if player_id exists
    if ($result->num_rows > 0) {
        if ($career_touchdowns != NULL) {
            $sql = "UPDATE $table SET career_touchdowns=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $career_touchdowns, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($career_receiving_yardage != NULL) {
            $sql = "UPDATE $table SET career_receiving_yardage=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $career_receiving_yardage, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($career_catches != NULL) {
            $sql = "UPDATE $table SET career_catches=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $career_catches, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($years_played != NULL) {
            $sql = "UPDATE $table SET years_played=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $years_played, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($current_team != "") {
            $sql = "UPDATE $table SET current_team=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $current_team, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($previous_team != "") {
            $sql = "UPDATE $table SET previous_team=? WHERE player_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $previous_team, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }
        
    }
    else {
        echo "<span style='color: red;'>Error: Player ID does not currently exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "update_coach.html") == 0) {
    $table = "Coach";
    $coach_id = $_POST['coach_id'];
    $team = $_POST['team'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Perform update operation
    $checkstmt2 = $mysqli->prepare("SELECT * FROM Coach WHERE coach_id=?");
    $checkstmt2->bind_param("i", $coach_id);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    // Check if coach_id exists
    if ($result2->num_rows > 0) {
        if ($team != "") {
            $sql = "UPDATE $table SET team=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $team, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($first_name != "") {
            $sql = "UPDATE $table SET first_name=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $first_name, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($last_name != "") {
            $sql = "UPDATE $table SET last_name=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $last_name, $player_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }
    }
    else {
        echo "<span style='color: red;'>Error: Coach ID does not exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "update_experience.html") == 0) {
    $table = "Experience";
    $coach_id = $_POST['coach_id'];
    $team = $_POST['team'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $years_coached = $_POST['years_coached'];
    $coach_type = $_POST['coach_type'];

    // Perform update operation
    $checkstmt2 = $mysqli->prepare("SELECT * FROM Experience WHERE coach_id=?");
    $checkstmt2->bind_param("i", $coach_id);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    // Check if coach ID exists
    if ($result2->num_rows > 0) {
        if ($team != "") {
            $sql = "UPDATE $table SET team=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $team, $coach_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($first_name != "") {
            $sql = "UPDATE $table SET first_name=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $first_name, $coach_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($last_name != "") {
            $sql = "UPDATE $table SET last_name=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $last_name, $coach_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($years_coached != NULL) {
            $sql = "UPDATE $table SET years_coached=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii", $years_coached, $coach_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
        }

        if ($coach_type != "") {
            $sql = "UPDATE $table SET coach_type=? WHERE coach_id=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $coach_type, $coach_id);
    
            if ($stmt->execute()) {
                echo "<span style='color: red;'>Record updated.</span>";
            }
            else {
                echo "<span style='color: red;'>Error updating entry. Please try again.</span>";
            }
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