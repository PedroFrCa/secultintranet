<?php
$tabela = $_POST["tabela"];

include('database_connection.php');
$sql = "SELECT MAX(id) as ID FROM $tabela";
$result = $connect->query($sql);
$row = $result->fetch_assoc();
$max_id = $row['ID'];
echo json_encode($max_id);
?>