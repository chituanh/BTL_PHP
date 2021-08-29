<?php
$sql_teacher = "SELECT * FROM giaovien";
$query_teacher = mysqli_query($connect, $sql_teacher);

$sql_PM = "SELECT * FROM phongmay WHERE tinhTrang = 'hoạt động'";
$query_PM = mysqli_query($connect, $sql_PM);

if (isset($_POST['sbm'])) {
    $idGiaoVien = $_POST['idGiaoVien'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $idPhongMay = $_POST['idPhongMay'];

    $sql = "INSERT INTO lichtruc(idGiaoVien, timeStart, timeEnd,idPhongMay) VALUES('$idGiaoVien', '$timeStart', '$timeEnd', $idPhongMay)";

    $query = mysqli_query($connect, $sql);
    echo "<script>";
    echo "location.href='index.php'";
    echo "</script>";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm lịch trực</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Giáo viên</label>
                    <select class="form-control" name="idGiaoVien">
                        <?php
                        while ($row_teacher = mysqli_fetch_assoc($query_teacher)) { ?>
                            <option value="<?php echo $row_teacher['idGiaoVien']; ?>"><?php echo $row_teacher['nameGiaoVien']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Thời gian bắt đầu</label> <br>
                    <input type="datetime-local" name="timeStart">
                </div>

                <div class="form-group">
                    <label>Thời gian kết thúc</label><br>
                    <input type="datetime-local" name="timeEnd">
                </div>


                <div class="form-group">
                    <label>Phòng Máy</label>
                    <select class="form-control" name="idPhongMay">
                        <?php
                        while ($row_PM = mysqli_fetch_assoc($query_PM)) { ?>
                            <option value="<?php echo $row_PM['idPhongMay']; ?>"><?php echo $row_PM['namePhongMay']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>