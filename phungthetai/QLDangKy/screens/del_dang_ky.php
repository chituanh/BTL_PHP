<?php
$id = $_GET['id'];
$sql = "DELETE FROM lichtruc WHERE idLichTruc = $id";
$query = mysqli_query($connect, $sql);
header('location: index.php');
