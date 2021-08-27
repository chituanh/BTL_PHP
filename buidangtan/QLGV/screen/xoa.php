<?php
    $id = $_GET['id'];
    $sql = "DELETE FROM giaovien WHERE idGiaoVien = $id";
    $query = mysqli_query($connect, $sql);
    header('location: index.php');
