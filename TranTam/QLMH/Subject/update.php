<?php
$id = $_GET['id'];

$sql_teacher = "SELECT * FROM giaovien";
$query_teacher = mysqli_query($connect, $sql_teacher);

$sql_up = "SELECT * FROM monhoc WHERE idMonHoc = $id";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);

if (isset($_POST['sbm'])) {
    $subjectName = $_POST['subjectName'];
    $startDate = $_POST['startDate'];
    $finishDate = $_POST['finishDate'];
    $numberLesson = $_POST['numberLesson'];
    $requireComputer = $_POST['requireComputer'];
    $idTeacher = $_POST['idGiaoVien'];

    $sql = "UPDATE monhoc SET nameMonHoc  = '$subjectName', ngayBatDau = '$startDate', ngayKetThuc = '$finishDate', soTiet = $numberLesson, yeuCauPhongMay = '$requireComputer', idGiaoVien = $idTeacher WHERE idMonHoc = $id";
    $query = mysqli_query($connect, $sql);
    echo "<script>";
    echo "location.href='index.php'";
    echo "</script>";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm sản phẩm</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên môn học</label>
                    <input type="text" name="subjectName" class="form-control" value="<?php echo $row_up['nameMonHoc']; ?>">
                </div>

                <div class="form-group">
                    <label>Ngày bắt đầu</label> <br>
                    <input type="date" name="startDate" value="<?php echo $row_up['ngayBatDau']; ?>">
                </div>

                <div class="form-group">
                    <label>Ngày kết thúc</label><br>
                    <input type="date" name="finishDate" value="<?php echo $row_up['ngayKetThuc']; ?>">
                </div>

                <div class="form-group">
                    <label>Số tiết</label><br>
                    <input type="number" name="numberLesson" value="<?php echo $row_up['soTiet']; ?>">
                </div>

                <div class="form-group">
                    <label>Yêu cầu phòng máy</label>
                    <input type="text" name="requireComputer" class="form-control" value="<?php echo $row_up['yeuCauPhongMay']; ?>">
                </div>

                <div class="form-group">
                    <label>Giáo viên</label>
                    <select class="form-control" name="idGiaoVien">
                        <?php
                        while ($row_teacher = mysqli_fetch_assoc($query_teacher)) { ?>
                            <option <?php if ($row_teacher['idGiaoVien'] == $row_up['idGiaoVien']) echo "selected"; ?> value="<?php echo $row_teacher['idGiaoVien']; ?>"><?php echo $row_teacher['nameGiaoVien']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>
</div>



