<?php
    $id = $_GET['id'];
    $sql = "DELETE FROM phongmay WHERE idPhongMay = $id";
    $query = mysqli_query($connect, $sql);
    header('location: index.php');
