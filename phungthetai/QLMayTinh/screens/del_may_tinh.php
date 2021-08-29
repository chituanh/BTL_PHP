<?php
$id = $_GET['id'];
$sql = "DELETE FROM maytinh WHERE idMayTinh = $id";
$query = mysqli_query($connect, $sql);
echo "<script>";
echo "location.href='index.php'";
echo "</script>";
