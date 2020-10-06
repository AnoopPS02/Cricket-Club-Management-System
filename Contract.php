<?php

    if (isset($_POST['submit']))
    {
        require "connection.php";
        require "manualCommit.php";


        // contracts Table ---------------------------------------------------------------------------------------------
        $player_ID = $_POST['playerID'];
        $start_date = $_POST['startDate'];
        $end_date = $_POST['endDate'];
        $contract_amount = $_POST['contractAmount'];

        // Check if the player has a running contract with another club
        $contractExists = false;

        $getEndDate = "SELECT contract_end_date FROM contracts WHERE playerID = '$player_ID'";

        if ($result = mysqli_query($conn, $getEndDate))
        {
            if (mysqli_num_rows($result) > 0)
            {
                while ($endDt = mysqli_fetch_assoc($result))
                {
                    $date1 = new DateTime($endDt['contract_end_date']);
                    $date2 = new DateTime($start_date);

                    if($date1 > $date2)
                        $contractExists = true;
                }
            }
        }

        // payment_schedule Table --------------------------------------------------------------------------------------
        $payment_serial = array();
        $due_date = array();
        $payment_date = array();
        $amount_paid = array();

        for ($i=0; $i<20; $i++)
        {
            if (isset($_POST["paymentDate" . $i]))
            {
                $payment_serial[$i] = $_POST["contractSerial" . $i];
                $due_date[$i] = $_POST["dueDate" . $i];
                $payment_date[$i] = $_POST["paymentDate" . $i];
                $amount_paid[$i] = $_POST["paidAmount" . $i];
            }
        }

        // The sum of the total payment of the schedule cannot be more than the fee mentioned in the contract
        $sum = 0;

        foreach ($amount_paid as $value)
        {
            $sum += $value;
        }


        if ($contractExists)
        {
            echo "<script> alert('A player cannot enroll into two clubs simultaneously'); </script>";
            mysqli_close($conn);
        }

         else if ($sum > $contract_amount)
        {
            echo "<script> alert('The sum of the total payment of the schedule cannot be more than the fee mentioned in the contract'); </script>";
            mysqli_close($conn);
        }

        else
        {
            // Insert into the contracts table
            $contractQuery = "INSERT INTO contracts (playerID, contract_start_date, contract_end_date, contract_amount) VALUES ( '$player_ID', '$start_date', '$end_date', '$contract_amount')";

            commitTable($conn, $contractQuery);

            // Get payment ID from contracts table
            $getPaymentID = "SELECT MAX(paymentID) AS LastPaymentID FROM contracts";

            if ($result = mysqli_query($conn, $getPaymentID))
                if (mysqli_num_rows($result) > 0)
                    $pID = mysqli_fetch_assoc($result);

            // Insert into the payment_schedule table
            if (!empty($payment_date[0]))
            {
                $paymentQuery = "INSERT INTO payment_schedule(paymentID, due_date, actual_payment_date, amount_paid, payment_serial)VALUES ('" . $pID['LastPaymentID'] . "', '$due_date[0]', '$payment_date[0]', '$amount_paid[0]', '$payment_serial[0]')";

                for ($i = 1; $i < 15; $i++)
                {
                    if (!empty($payment_date[$i]))
                        $paymentQuery .= ", ('" . $pID['LastPaymentID'] . "', '$due_date[$i]', '$payment_date[$i]', '$amount_paid[$i]', '$payment_serial[$i]')";
                    else
                        break;
                }

                commitTable($conn, $paymentQuery);
            }

            mysqli_close($conn);
        }
    }
?>





<html>

<link rel="stylesheet" type="text/css" href="ss.css">

<script type="text/javascript">

    let rowCount = 2;

    function addSchedule()
    {
        let table = document.getElementById("ScheduleTable");
        let row = table.insertRow(rowCount);
        let cell1 = row.insertCell(0);
        let cell2 = row.insertCell(1);
        let cell3 = row.insertCell(2);
        let cell4 = row.insertCell(3);

        rowCount--;

        cell1.innerHTML = '<input type="number" name="contractSerial' + rowCount + '" value="' + rowCount + '" title="Serial Number" required>';
        cell2.innerHTML = '<input type="date" name="dueDate' + rowCount + '" title="Due date" required>';
        cell3.innerHTML = '<input type="date" name="paymentDate' + rowCount + '" title="Payment date" required>';
        cell4.innerHTML = '<input type="text" name="paidAmount' + rowCount + '" title="Amount" required>';

        rowCount += 2;
    }

</script>

<head>
    <meta charset="UTF-8">
	<title>Contract Form</title>
</head>

<ul>
    <li><a href="Home.html">Home</a></li>
    <li><a class="active" href="Reg.php">Registration</a></li>
    <li><a href="Club.php">Information</a></li>
</ul>

<div class="contractPage">
    <h1 class="pageName">Contract Form</h1>
</div>

<ul class="subMenu">
    <li><a href="Reg.php">Player Registration</a></li>
    <li><a class="active" href="Contract.php">Contract Form</a></li>
</ul>

<body>

<div class="forms">
	<form class="forms" action="Contract.php" method="post">        


        <h4 class="headers">Contract Period </h4>
        Player ID: <input type="number" name="playerID" title="PLayer ID" placeholder="Player ID"><br><br>
        Start Date : <input type="date" name="startDate" title="Start Date"><br><br>
        End Date : <input type="date" name="endDate" title="End Date"><br><br>
        Contract Amount : <input type="text" name="contractAmount" title="Contract Amount" placeholder="Contract Amount"><br><br>


        <table id="ScheduleTable" border = "1" cellspacing="0" cellpadding="1">
            <caption><h4 class="headers">Payment Schedule</h4></caption>
            <tr>
                <th>Serial Number</th>
                <th>Due date</th>
                <th>Payment date</th>
                <th>Amount</th>
            </tr>

            <tr>
                <td><input type="number" name="contractSerial0" value="0" title="Serial Number" required></td>
                <td><input type="date" name="dueDate0" title="Due date" required></td>
                <td><input type="date" name="paymentDate0" title="Payment date" required></td>
                <td><input type="text" name="paidAmount0" title="Amount" required></td>
            </tr>

        </table>
        <br><br>

        <input type="submit" name="submit">

    </form>
</div>

</body>

</html>