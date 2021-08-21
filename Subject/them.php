<?php
$sql_teacher = "SELECT * FROM giaovien";
$query_teacher = mysqli_query($connect, $sql_teacher);

if (isset($_POST['sbm'])) {
    $subjectName = $_POST['subjectName'];
    $startDate = $_POST['startDate'];
    $finishDate = $_POST['finishDate'];
    $numberLesson = $_POST['numberLesson'];
    $requireComputer = $_POST['requireComputer'];
    $idTeacher = $_POST['idGiaoVien'];

    $sql = "INSERT INTO monhoc(nameMonHoc, ngayBatDau, ngayKetThuc, soTiet, yeuCauPhongMay, idGiaoVien) VALUES('$subjectName', '$startDate', '$finishDate', $numberLesson, '$requireComputer', $idTeacher)";

    $query = mysqli_query($connect, $sql);
    header('location: index.php');
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
                    <input type="text" name="subjectName" class="form-control">
                </div>

                <div class="form-group">
                    <label>Ngày bắt đầu</label> <br>
                    <input type="date" name="startDate">
                </div>

                <div class="form-group">
                    <label>Ngày kết thúc</label><br>
                    <input type="date" name="finishDate">
                </div>

                <div class="form-group">
                    <label>Số tiết</label><br>
                    <input type="number" name="numberLesson">
                </div>

                <div class="form-group">
                    <label>Yêu cầu phòng máy</label>
                    <input type="text" name="requireComputer" class="form-control">
                </div>

                <div class="form-group">
                    <label>Giáo viên</label>
                    <select class="form-control" name="idGiaoVien">
                        <?php
                        while ($row_teacher = mysqli_fetch_assoc($query_teacher)) { ?>
                            <option value="<?php echo $row_teacher['idGiaoVien']; ?>"><?php echo $row_teacher['nameGiaoVien']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>