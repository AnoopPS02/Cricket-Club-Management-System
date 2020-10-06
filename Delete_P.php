<?php

$player_name=$_POST['playerSearch'];

$connection = mysqli_connect('localhost','root','','cric_db');
if(!$connection)
{
    die("database connection failed".mysqli_error($connection));
}
$select_db=mysqli_select_db($connection,'cric_db');
if(!$select_db)
{
    die("database selection failed".mysqli_error($connection));
}

$query="DELETE FROM players WHERE playerID='$player_name'";
       $result=mysqli_query($connection,$query) or die(mysqli_error($connection));
    echo "deleted seccessfully";

?>