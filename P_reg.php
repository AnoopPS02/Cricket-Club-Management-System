<?php
	
	if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // Players Table -----------------------------------------------------------------------------------------------
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $father_name = $_POST['father'];
        $mother_name = $_POST['mother'];
        
        $date_of_birth = $_POST['dob'];
        

        // Age of a player cannot be more than 35 years
        $date2 = date("d-m-Y");//today's date

        $date1 = new DateTime($date_of_birth);
        $date2 = new DateTime($date2);

        $interval = $date1->diff($date2);

        $age = $interval->y;

        if ($age > 35)
        {
            echo "<script> alert('Age of a player cannot be more than 35 years'); </script>";
            mysqli_close($conn);
        }

        else
        {
            
        $playerQuery = "INSERT INTO players (first_name, last_name, father_name, mother_name, date_of_birth)
        VALUES ('$first_name', '$last_name', '$father_name', '$mother_name', '$date_of_birth')";

            commitTable($conn, $playerQuery);
            
            $degree = array();
            $institution = array();
            $department = array();
            $result = array();
            $year = array();

            for ($i = 0; $i < 10; $i++)
            {
                if (isset($_POST["degree" . $i]))
                {
                    $degree[$i] = $_POST["degree" . $i];
                    $institution[$i] = $_POST["institute" . $i];
                    $department[$i] = $_POST["dept" . $i];
                    $year[$i] = $_POST["year" . $i];
                    $result[$i] = $_POST["result" . $i];
                    
                }
            }

            if (!empty($degree[0]))
            {
                $educationQuery = "INSERT INTO education ( degree, institution, department, year,result)
                VALUES ( '$degree[0]', '$institution[0]', '$department[0]', '$year[0]', '$result[0]')";


                for ($i = 1; $i < 10; $i++)
                {
                    if (!empty($degree[$i]))
                        $educationQuery .= ", ('$degree[$i]', '$institution[$i]', '$department[$i]',  '$year[$i]','$result[$i]',)";
                    else
                        break;
                }

                commitTable($conn, $educationQuery);
            }
            
            $club = array();
            $transferred_to = array();
            $transferred_from = array();
            $total_runs = array();
            $total_wickets = array();

            for ($i = 0; $i < 10; $i++)
            {
                if (isset($_POST["clubPlayedFor" . $i]))
                {
                    $club[$i] = $_POST["clubPlayedFor" . $i];
                    $transferred_to[$i] = $_POST["transferredTo" . $i];
                    $transferred_from[$i] = $_POST["transferredFrom" . $i];
                    $total_runs[$i] = $_POST["totalRuns" . $i];
                    $total_wickets[$i] = $_POST["totalWickets" . $i];
                }
            }

            // Get player ID from players table
            $getPlayerID = "SELECT MAX(playerID) AS LastPlayerID FROM players";

            if ($result = mysqli_query($conn, $getPlayerID))
                if (mysqli_num_rows($result) > 0)
                    $pID = mysqli_fetch_assoc($result);

            // Insert into the player_history table
            if (!empty($club[0]))
            {
                $playerHistoryQuery = "INSERT INTO player_history (playerID, club_name, transferred_to, transferred_from, total_runs, total_wickets)VALUES ('" . $pID['LastPlayerID'] . "', '$club[0]', '$transferred_to[0]', '$transferred_from[0]', '$total_runs[0]', '$total_wickets[0]')";


                for ($i = 1; $i < 10; $i++)
                {
                    if (!empty($club[$i]))
                        $playerHistoryQuery .= ", ('" . $pID['LastPlayerID'] . "', '$club[$i]', '$transferred_to[$i]', '$transferred_from[$i]', '$total_runs[$i]', '$total_wickets[$i]')";
                    else
                        break;
                }
                commitTable($conn, $playerHistoryQuery);
            }
            
            mysqli_close($conn);
            
        }
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
    <h1 class="pageName">Player Registration Form</h1>
</div>

<ul class="subMenu">
    <li><a class="active" href="P_reg.php">Player Registration</a></li>
    <li><a href="Contract.php">Contract Form</a></li>
</ul>
    
    <div class="forms">
	<form class="forms" action="P_reg.php" method="post">

        <h4 class="headers">General Information </h4>

		First Name: <input type="text" name="firstName" title="First Name" placeholder="Your First Name" required><br><br>
		Last Name: <input type="text" name="lastName" title="Last Name" placeholder="Your Last Name" required><br><br>
		Father's Name: <input type="text" name="father" title="Father's Name" placeholder="Your Father's Name"><br><br>
		Mother's Name: <input type="text" name="mother" title="Mother's Name" placeholder="Your Mother's Name"><br><br>
        Date of Birth: <input type="date" name="dob" title="Date of Birth"><br><br>
        
        <table id="EducationTable" border = "1" cellspacing="0" cellpadding="1">
            <caption><h4 class="headers">Educational Qualifications</h4></caption>
            <tr>
                <th>Name of degree</th>
                <th>Institute/Department</th>
                <th>Board/University</th>
                <th>Year</th>
                <th>Result</th>
            </tr>

            <tr>
                <td><input type="text" name="degree0" title="Name of degree"></td>
                <td><input type="text" name="dept0" title="Institute/Department"></td>
                <td><input type="text" name="institute0" title="Board/University"></td>
                <td><input type="text" name="year0" title="Year"></td>
                <td><input type="text" name="result0" title="Result"></td>
            </tr>

        </table>
        
         <table id="historyTable" border = "1" cellspacing="0" cellpadding="1">
            <caption><h4 class="headers">Previous History</h4></caption>

            <tr>
                <th>Club Name</th>
                <th>From</th>
                <th>To</th>
                <th>Total Runs</th>
                <th>Total Wickets</th>
            </tr>

            <tr>
                <td><input type="text" name="clubPlayedFor0" title="Club Name"></td>
                <td><input type="text" name="transferredTo0" title="From"></td>
                <td><input type="text" name="transferredFrom0" title="To"></td>
                <td><input type="text" name="totalRuns0" title="Total Runs"></td>
                <td><input type="text" name="totalWickets0" title="Total Wickets"></td>
                
            </tr>

        </table>
        
       <input type="submit" name="submit">

        
        </form>
    </div>
    </body>
</html>