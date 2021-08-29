<?php
    $id = $_GET['id'];
    $sql = "DELETE FROM giaovien WHERE idGiaoVien = $id";
    $query = mysqli_query($connect, $sql);
echo "<script>";
echo "location.href='index.php'";
echo "</script>";
