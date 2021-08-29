<?php

if (isset($_POST['sbm'])) {
    $classroomName = $_POST['classroomName'];
    $status = $_POST['status'];
    $numberComputer = $_POST['numberComputer'];


    $sql = "INSERT INTO phongmay(namePhongMay, tinhTrang, soLuongMay) VALUES('$classroomName', '$status', $numberComputer)";
    $query = mysqli_query($connect, $sql);
    echo "<script>";
    echo "location.href='index.php'";
    echo "</script>";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm phòng học</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên phòng máy</label>
                    <input type="text" name="classroomName" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tình trạng</label><br>
                    <input type="text" name="status" class="form-control">
                </div>

                <div class="form-group">
                    <label>Số lượng máy</label> <br>
                    <input type="number" name="numberComputer">
                </div>
                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>