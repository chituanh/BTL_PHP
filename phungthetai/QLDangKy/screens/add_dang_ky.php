<?php
// session_start();

$sqlPhongMay = "SELECT * FROM phongmay";
$queryPhongMay = mysqli_query($connect, $sqlPhongMay);



if (isset($_POST['sbm'])) {

    $sql_up = "SELECT * FROM lichtruc WHERE idLichTruc = $id";
    $query_up = mysqli_query($connect, $sql_up);
    $row_up = mysqli_fetch_assoc($query_up);

    $idPhongMay = $_POST['sePhongMay'];
    $timeStart = $_POST['txtDateStart'];
    $timeEnd = $_POST['txtDateEnd'];
    $id = $_SESSION['idUser'];

    try {
        $sql = "INSERT INTO `lichtruc` VALUES (NULL, $idPhongMay, $id, " . " '" . "$timeStart" . "'" . ","  . " '" . "$timeEnd"  . "' )";
        echo $sql;
        $query = mysqli_query($connect, $sql);
        echo "<script>";
        echo "location.href='index.php'";
        echo "</script>";
    } catch (Exception $err) {
    }
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm Lịch Trực</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">



                <div class="form-group">
                    <label>Phòng Máy</label>
                    <select name="sePhongMay" class="form-select form-control" aria-label="Default select example">
                        <?php
                        while ($row = mysqli_fetch_assoc($queryPhongMay)) { ?>
                            <option value="<?php echo $row['idPhongMay']; ?>"> <?php echo  $row['namePhongMay'];  ?> </option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Thời Gian bắt đầu</label>
                    <input type="datetime-local" name="txtDateStart" class="form-control">
                </div>

                <div class="form-group">
                    <label>Thời gian kết thúc</label>
                    <input type="datetime-local" name="txtDateEnd" class="form-control">
                </div>


                <button name="sbm" class="btn btn-success ">Thêm Lịch Trực</button>
            </form>
        </div>
    </div>
</div>