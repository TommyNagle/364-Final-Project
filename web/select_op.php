<?php

include('authenticate.php')

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

        <h2>Select an Operation to Perform</h2> <br>
        <div name="categories">
            
            <select name="filter" id="filter">
                <option value="insert_player.html">Insert</option>
                <option value="update_player.html">Update</option>
                <option value="delete_player.html">Delete</option>
            </select> <br> <br>

        </div> <br>

        <button onclick="navigate()">Edit</button> <br>

        <form style="background-color: black" action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
        
    </main>

    <script>
        function navigate() {
            var filter = document.getElementById("filter");
            var nextPage = filter.value;
            window.location.href = nextPage;
        }
    </script>
        
</body>
</html>