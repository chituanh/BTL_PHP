<?php
try {
    // session_start();
    // require_once '../controller/list_dang_ky_controller.php';
    function rows($query)
    {
        $rows = [];
        while ($hi = $query->fetch_row()) {
            array_push($rows, $hi);
        }
        return $rows;
    }

    function fetchRosDate($dateNe, $rows)
    {
        $ans = [];
        foreach ($rows as $i) {
            $date1 = date_create_from_format('d-m-Y', date_create($i[3])->format('d-m-Y'));
            $date2 = date_create_from_format('d-m-Y', date_create($i[4])->format('d-m-Y'));
            $hi1 = $dateNe->diff($date1);
            $hi2 = $dateNe->diff($date2);
            $hi3 = $date1->diff($date2);
            if ($hi1->days  == 0 || $hi2->days == 0) {
                array_push($ans, $i);
            } else if (($hi1->days) + ($hi2->days) <= $hi3->days) {
                array_push($ans, $i);
            }
        }
        return $ans;
    }
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

    function checkGV($id)
    {
        if ($_SESSION['idUser'] == $id) {
            return true;
        }
        return false;
    }


    if (isset($_SESSION['idUser']))
        $idGiaoVien = $_SESSION['idUser'];

    $dateStart = new DateTime('NOW');
    $dateEnd = (new DateTime('NOW'))->add(new DateInterval('P20D'));
    $dateNow = new DateTime('NOW');
    if (isset($_POST['reload'])) {
        $dateStart = date_create_from_format('Y-m-d', $_POST['txtDateStart']);
        $dateEnd = date_create_from_format('Y-m-d', $_POST['txtDateEnd']);
    }
    $sql = "SELECT * FROM lichtruc";
    $query = mysqli_query($connect, $sql);
    $rows = rows($query);
    $listGV = getListGV($connect);
    $listPM = getListPM($connect);
} catch (Exception $err) {
    echo 'l???i r???i';
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>L???ch Tr???c</h2>
        </div>

        <div class="card-body">
            <?php
            if (isset($total_subject)) {
                if ($total_subject !== 0) {
                    echo "<p class='text-success'>T??m th???y $total_subject m??n h???c</p>";
                } else {
                    echo "<p class='text-danger'> Kh??ng t??m th???y m??n h???c n??o! </p>";
                }
            }
            ?>
            <tr>
                <div class="card-footer d-flex justify-content-around">

                    <form>
                        <a href="index.php?page_layout=them" class="btn btn-primary">
                            Th??m l???ch tr???c
                        </a>
                    </form>

                    <form method="POST" class="d-flex align-items-center">
                        <label class="p-2">Th???i gian b???t ?????u</label>
                        <div class="form-group">

                            <input type="date" name="txtDateStart" class="form-control" value="<?php echo $dateStart->format('Y-m-d'); ?>">
                        </div>
                        <label class="p-2">Th???i gian k???t th??c</label>
                        <div class="form-group">

                            <input type="date" name="txtDateEnd" class="form-control" value="<?php echo $dateEnd->format('Y-m-d'); ?>">
                        </div>
                        <div class="button pb-3 px-2">
                            <button class="btn btn-primary" name="reload" type="submit">
                                L???c d??? li???u
                            </button>
                        </div>

                    </form>



                </div>
            </tr>

            <table class="table bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Th???</th>
                        <th>Ng??y</th>
                        <th>L???ch Tr???c</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                    $interval = DateInterval::createFromDateString('1 day');
                    $period = new DatePeriod($dateStart, $interval, $dateEnd);
                    foreach ($period as $dt) { ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $dt->format('l'); ?> </td>
                            <td><?php echo $dt->format('d-m-Y'); ?> </td>
                            <td><?php $cayThe = date_create_from_format('d-m-Y', $dt->format('d-m-Y'));
                                $lu =  fetchRosDate($cayThe, $rows);
                                foreach ($lu as $hi) { ?>
                                    <div>
                                        <?php
                                        echo "<br/>";
                                        echo "<b>Ph??ng M??y: </b>"  . check($hi[1], $listPM) . '- <b>T??n Gi??o Vi??n:</b>  ' . check($hi[2], $listGV) . '<br/>' . '<b>Th???i Gian:</b> (' . date_create($hi[3])->format('g:i a d-m-Y') . '  --> ' . date_create($hi[4])->format('g:i a d-m-Y') . ") ";
                                        if (checkGV($hi[2])) {
                                            $idLich = $hi[0]; ?>
                                            <a class="btn btn-warning" href="index.php?page_layout=sua&id=<?php echo $idLich; ?>">S???a</a>
                                            <a onclick="return Del('<?php echo 'L???ch Tr???c'; ?>')" class="btn btn-danger" href="index.php?page_layout=xoa&id='<?php echo $hi[0]; ?>'">X??a</a>
                                    </div>
                            <?php }
                                        echo "<br/>";
                                    } ?>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>


    </div>
</div>

<script>
    function Del(name) {
        return confirm("B???n c?? ch???c ch???n mu???n x??a: " + name + " ?");
    }
</script>