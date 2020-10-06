<?php
    include_once "connection.php";
?>


<html>
    <link rel="stylesheet" type="text/css" href="ss.css">
    <head>
    <meta charset="UTF-8">
	<title>Player Registration Form</title>
</head>
<body>
<ul>
    <li><a href="Home.html">Home</a></li>
    <li><a class="active" href="Reg.php">Registration</a></li>
    <li><a href="Club.php">Information</a></li>
</ul>
    <div class="playerPage">
    <h1 class="pageName">CLUB INFORMATION</h1>
</div>
    
    <ul class="subMenu">
    <li><a class="active" href="P_SEARCH.php">Player Profile</a></li>
    <li><a class="active" href="">Staff Profile</a></li>
</ul>
    <body>

<div class="forms">
    <form class="forms" action="P_PROFILE.php" method="post">

        <h4 class="headers">Search using player ID </h4>

        <input type="search" name="playerSearch" title="Search using player ID" placeholder="Search..." required><br><br>

        <input type="submit" name="Search">

    </form>
</div>

</body>

    </body>
</html>