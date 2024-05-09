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

// Get name form value
$team = $_GET['filter'];

// Select data from database
$stmt = $mysqli->prepare("SELECT name, year_founded, num_wins, num_widereceivers FROM Team WHERE name = ?");
$stmt->bind_param("s", $team);
$stmt->execute();
$teamResult = $stmt->get_result();

$stmt2 = $mysqli->prepare("SELECT Coach.first_name, Coach.last_name, Experience.years_coached, Experience.coach_type
    FROM Coach JOIN Experience ON Coach.coach_id=Experience.coach_id
    WHERE Coach.team = ?");
$stmt2->bind_param("s", $team);
$stmt2->execute();
$coachResult = $stmt2->get_result();
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
        <a href="player_search.html">Player Search</a>
        <a class="active" href="team_search.php">Team Search</a>
        <a href="rank.php">Statistic Summary</a>
        <a href="login.php">Admin Login</a>
    </nav> <br> <br>

    <main>
        <h2>NFL Team</h2>
        <table>
            <tr>
                <th>Team</th>
                <th>Year Founded</th>
                <th>Number of Wins for the season</th>
                <th>Number of Widereceivers</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$teamResult->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['year_founded'];?></td>
                <td><?php echo $rows['num_wins'];?></td>
                <td><?php echo $rows['num_widereceivers'];?></td>
            </tr>
            <?php
                }
            ?>
        </table> <br>

        <h2>Coaches</h2>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Years Coached</th>
                <th>Type of Coach</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$coachResult->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['first_name'];?></td>
                <td><?php echo $rows['last_name'];?></td>
                <td><?php echo $rows['years_coached'];?></td>
                <td><?php echo $rows['coach_type'];?></td>
            </tr>
            <?php
                }
            ?>
        </table> <br>

        <button onclick="navigate()">Return to Team Search</button> <br>
    </main>

    <script>
        function navigate() {
            window.location.href = "team_search.php";
        }
    </script>
        
</body>
</html>