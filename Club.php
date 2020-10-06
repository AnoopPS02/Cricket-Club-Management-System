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
    <li><a class="active" href="S_Search.php">Staff Profile</a></li>
</ul>
    
    <div class="forms">
    <?php
    // Players Table -----------------------------------------------------------------------------------------------

    $ClubInfo = "SELECT *
                    FROM Club";
        
        $result1 = mysqli_query($conn, $ClubInfo);
       while ($row = $result1->fetch_assoc()){

        echo "<br> Club ID: ". $row["ClubID"]."<br><br>";
        echo "<br> Club Name: ". $row["ClubName"]."<br><br>";
        echo "<br> President: ". $row["President"]."<br><br>";
         echo "<br> Established: ". $row["Club_formed"]."<br><br>"; 
         echo "<br> Address: ". $row["Address"]."<br><br>";   
       }

    ?>

    
    
    
    
    </div>
    <button class="button4" onclick="window.location.href = 'http://localhost/DBMS/Reg.php';">Add Player/Staff</button><br><br><br>
<button class="button3" onclick="window.location.href = 'http://localhost/DBMS/Del.php';">Delete Player</button><br><br><br>
<button class="button2" onclick="window.location.href = 'http://localhost/DBMS/stored.php';">View Player</button><br><br><br>


    
    
    </body>
</html>