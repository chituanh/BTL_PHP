<?php
session_start();
$id = $_GET['id'];

$sqlPhongMay = "SELECT * FROM phongmay";
$queryPhongMay = mysqli_query($connect, $sqlPhongMay);

$sql_up = "SELECT * FROM lichtruc WHERE idLichTruc = $id";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);



if (isset($_POST['sbm'])) {
    $idPhongMay = $_POST['sePhongMay'];
    $timeStart = $_POST['txtDateStart'];
    $timeEnd = $_POST['txtDateEnd'];

    try {
        $sql = "UPDATE `lichtruc` SET `idPhongMay`= $idPhongMay, `timeStart` =" . " '" . "$timeStart" . "'" . ", `timeEnd` =" . " '" . "$timeEnd"  . "' " . "WHERE idLichTruc = $id";
        $query = mysqli_query($connect, $sql);
        header('location: index.php');
    } catch (Exception $err) {
    }
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Sửa lịch trực</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">



                <div class="form-group">
                    <label>Phòng Máy</label>
                    <select name="sePhongMay" class="form-select form-control" aria-label="Default select example">
                        <?php
                        while ($row = mysqli_fetch_assoc($queryPhongMay)) { ?>
                            <option <?php if ($row['idPhongMay'] == $row_up['idPhongMay']) echo  'selected' ?> value="<?php echo $row['idPhongMay']; ?>"> <?php echo  $row['namePhongMay'];  ?> </option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Thời Gian bắt đầu</label>
                    <input type="datetime-local" name="txtDateStart" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row_up['timeStart'])); ?>">
                </div>

                <div class="form-group">
                    <label>Thời gian kết thúc</label>
                    <input type="datetime-local" name="txtDateEnd" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row_up['timeEnd'])); ?>">
                </div>


                <button name="sbm" class="btn btn-success ">Sửa</button>
            </form>
        </div>
    </div>
</div>