<?php

function getListGV($connect)
{
    $sql = 'SELECT * FROM `giaovien`';
    $queryGV = mysqli_query($connect, $sql);
    $rows = [];
    while ($hi = $queryGV->fetch_row()) {
        array_push($rows, $hi);
    }
    return $rows;
}

function getListPM($connect)
{
    $sql = 'SELECT * FROM `phongmay`';
    $queryPM = mysqli_query($connect, $sql);
    $rows = [];
    while ($hi = $queryPM->fetch_row()) {
        array_push($rows, $hi);
    }
    return $rows;
}

function check($id, $list)
{
    foreach ($list as $i) {
        if ($i[0] == $id) return $i[1];
    }
}
