<?php
    include_once "connection.php";
?>
<html>
    <link rel="stylesheet" type="text/css" href="ss.css">
    <head>
    <meta charset="UTF-8">
	<title>Player Registration Form</title>
</head>

<ul>
    <li><a href="Home.html">Home</a></li>
    <li><a class="active" href="Reg.php">Registration</a></li>
    <li><a href="Club.php">Information</a></li>
</ul>
    <div class="playerPage">
    <h1 class="pageName">Staff INFORMATION</h1>
</div>
    
    <ul class="subMenu">
    <li><a class="active" href="P_SEARCH.php">Player Profile</a></li>
    <li><a class="active" href="S_Search.php">Staff Profile</a></li>
</ul>
<body>

<div class="forms">

    <?php
    // Players Table -----------------------------------------------------------------------------------------------

    $query = $_POST['playerSearch'];

    $query = htmlspecialchars($query);

    $StaffInfo = "SELECT *
                    FROM staff_info WHERE Staffid='$query'";
        
        $result1 = mysqli_query($conn, $StaffInfo);
       while ($row = $result1->fetch_assoc()){

        echo "<br> Staff ID             : ". $row["Staffid"]."<br><br>";
        echo "<br> Staff Name           : ". $row["f_name"]."<br><br>";
        echo "<br> Date-of-Birth        : ". $row["dob"]."<br><br>";
         echo "<br> Role                : ". $row["role"]."<br><br>"; 
         echo "<br> Experience(in years): ". $row["Exp"]."<br><br>"; 
       }
    ?>

</div>

</body>
    

</html>