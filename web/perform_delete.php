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
if (strcmp($_POST['filter'], "delete_player.html") == 0) {
    $table = "Player";
    $input = $_POST['player_id'];
    $player_id = htmlspecialchars($input, ENT_QUOTES);

    // Perform delete operation
    $checkstmt = $mysqli->prepare("SELECT * FROM $table WHERE player_id=?");
    $checkstmt->bind_param("i", $player_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if player_id exists in database
    if ($result->num_rows > 0) {
        $sql = "DELETE FROM $table WHERE player_id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $player_id);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>Record deleted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error deleting entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Player ID does not currently exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "delete_team.html") == 0) {
    $table = "Team";
    $input = $_POST['name'];
    $name = htmlspecialchars($input, ENT_QUOTES);

    // Perform delete operation
    $checkstmt = $mysqli->prepare("SELECT * FROM $table WHERE name=?");
    $checkstmt->bind_param("s", $name);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if team name exists
    if ($result->num_rows > 0) {
        $sql = "DELETE FROM $table WHERE player_id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>Record deleted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error deleting entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Team name does not currently exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "delete_history.html") == 0) {
    $table = "History";
    $input = $_POST['player_id'];
    $player_id = htmlspecialchars($input, ENT_QUOTES);

    // Perform delete operation
    $checkstmt = $mysqli->prepare("SELECT * FROM History WHERE player_id=?");
    $checkstmt->bind_param("i", $player_id);
    $checkstmt->execute();
    $result = $checkstmt->get_result();

    // Check if player_id exists
    if ($result->num_rows > 0) {
        $sql = "DELETE FROM $table WHERE player_id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $player_id);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>Record deleted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error deleting entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Player ID does not currently exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "delete_coach.html") == 0) {
    $table = "Coach";
    $input = $_POST['coach_id'];
    $coach_id = htmlspecialchars($input, ENT_QUOTES);

    // Perform delete operation=
    $checkstmt2 = $mysqli->prepare("SELECT * FROM Coach WHERE coach_id=?");
    $checkstmt2->bind_param("i", $coach_id);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    // Check if coach_id exists
    if ($result2->num_rows > 0) {
        $sql = "DELETE FROM $table WHERE coach_id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $coach_id);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>Record deleted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error deleting entry. Please try again.</span>";
        }
    }
    else {
        echo "<span style='color: red;'>Error: Coach ID does not exist in database.</span>";
    }
}
elseif (strcmp($_POST['filter'], "delete_experience.html") == 0) {
    $table = "Experience";
    $input = $_POST['coach_id'];
    $coach_id = htmlspecialchars($input, ENT_QUOTES);

    // Perform delete operation
    $checkstmt2 = $mysqli->prepare("SELECT * FROM Experience WHERE coach_id=?");
    $checkstmt2->bind_param("i", $coach_id);
    $checkstmt2->execute();
    $result2 = $checkstmt2->get_result();

    // Check if coach ID exists
    if ($result2->num_rows > 0) {
        $sql = "DELETE FROM $table WHERE player_id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $player_id);

        if ($stmt->execute()) {
            echo "<span style='color: red;'>Record deleted.</span>";
        }
        else {
            echo "<span style='color: red;'>Error deleting entry. Please try again.</span>";
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