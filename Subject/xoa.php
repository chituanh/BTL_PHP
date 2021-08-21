<?php
    $id = $_GET['id'];
    $sql = "DELETE FROM monhoc WHERE idMonHoc = $id";
    $query = mysqli_query($connect, $sql);
    header('location: index.php');
