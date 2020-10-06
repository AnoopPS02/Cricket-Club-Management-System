<?php
	
	if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";
        
        //Staff_info table
        
        $f_name = $_POST['firstName'];
        $l_name = $_POST['lastName'];
        $dob = $_POST['dob'];
        $role = $_REQUEST['role'];
        $Exp = $_POST['exp'];
        
         
        $playerQuery = "INSERT INTO Staff_info (f_name, l_name, dob, role, Exp)
        VALUES ('$f_name', '$l_name',  '$dob', '$role', '$Exp')";

        commitTable($conn, $playerQuery);
        
        
        $Clubname = $_POST['club'];
        $From = $_POST['transferf'];
        $To = $_POST['transfert'];
        $Pre_Role = $_REQUEST['opt'];

        $preQuery = "INSERT INTO staff_previous (Clubname, From, To, Pre_Role)
        VALUES ('$Clubname', '$From', '$To', '$Pre_Role')";
        
        commitTable($conn, $preQuery);

         mysqli_close($conn);
    }
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
    <h1 class="pageName">Staff Registration Form</h1>
</div>

<ul class="subMenu">
    <li><a class="active" href="S_Reg.php">Staff Registration</a></li>
</ul>
    
    <div class="forms">
	<form class="forms" action="S_Reg.php" method="post">

        <h4 class="headers">General Information </h4>

		First Name: <input type="text" name="firstName" title="First Name" placeholder="Your First Name" required><br><br>
		Last Name: <input type="text" name="lastName" title="Last Name" placeholder="Your Last Name" required><br><br>
        Date of Birth: <input type="date" name="dob" title="Date of Birth"><br><br>
        Role: <select name="role">
                <option value="Batting coach">Batting Coach</option>
                <option value="Bowling coach">Bowling Coach</option>
                <option value="Fielding coach">Fielding coach</option>
                <option value="Physical Trainer">Physical Trainer</option>
                <option value="Medical">Medical</option>
        
        </select>
        Experience: <input type="number" name="exp" title="Experience" placeholder="Experience" required><br><br>
        
         <table id="historyTable" border = "1" cellspacing="0" cellpadding="1">
            <caption><h4 class="headers">Previous History</h4></caption>

            <tr>
                <th>Club Name</th>
                <th>From</th>
                <th>To</th>
                <th>Role</th>
            </tr>

            <tr>
                <td><input type="text" name="club" title="Club Name"></td>
                <td><input type="text" name="transferf" title="From"></td>
                <td><input type="text" name="transfert" title="To"></td>
                <td><select name="opt"><option value="Batting">Batting</option>
                    <option value="Bowling">Bowling</option>
                    <option value="Fielding">Fielding</option>
                    <option value="Trainer">Phy Trainer</option>
                    <option value="Medical">Medical</option></select>

                
            </tr>

        </table>
        
       <input type="submit" name="submit">

        
        </form>
    </div>
    </body>
</html>