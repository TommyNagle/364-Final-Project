<!-- PHP code to establish connection with the localserver -->
<?php
 
// Username is root
$user = 'student';
$password = 'CompSci364';
 
// Database name is geeksforgeeks
$database = 'student';
 
// Server is localhost with
// port number 3306
$servername='localhost';
$mysqli = new mysqli($servername, $user,
                $password, $database);
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$stmt = $mysqli->prepare(" SELECT * FROM Player ORDER BY receiving_yardage DESC ");
$stmt->execute();
$result = $stmt->get_result();
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
        <a href="team_search.php">Team Search</a>
        <a class="active" href="yardage.php">Statistic Summary</a>
        <a href="login.php">Admin Login</a>
    </nav> <br> <br>

    <main>
        <h2>Player Rankings</h2>
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
                while($rows=$result->fetch_assoc())
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

        <div class="categories">
            <label for="filter">Choose a Category to Sort by:</label>
            <select name="filter" id="filter">
                <option value="yardage.php">Recieving Yardage</option>
                <option value="rank.php">Rank</option>
                <option value="touchdowns.php">Touchdowns</option>
                <option value="catches.php">Catches</option>
            </select> 
            <button onclick="navigate()">Sort</button> <br>
        </div>

        <script>
            function navigate() {
                var filter = document.getElementById("filter");
                var nextPage = filter.value;
                window.location.href = nextPage;
            }
        </script>
    </main>
        
</body>
</html>