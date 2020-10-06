<?php
$conn = new PDO("mysql:host=localhost;dbname=cric_db",'root','');
$sql="CALL getPlayers()";
$result = $conn->prepare($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$result->execute();
while($values= $result->fetch())
{
print"<list of players>";
print_r($values);
}
?>