<?php
$id = $_GET['id'];

$sql_up = "SELECT * FROM phongmay WHERE idPhongMay = $id";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);

if (isset($_POST['sbm'])) {
    $classroomName = $_POST['classroomName'];
    $status = $_POST['status'];
    $numberComputer = $_POST['numberComputer'];

    $sql = "UPDATE phongmay SET namePhongMay  = '$classroomName', tinhTrang = '$status', soLuongMay = '$numberComputer' WHERE idPhongMay = $id";
    $query = mysqli_query($connect, $sql);
    echo "<script>";
    echo "location.href='index.php'";
    echo "</script>";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Sửa phòng học</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên phòng máy</label>
                    <input type="text" name="classroomName" class="form-control" value="<?php echo $row_up['namePhongMay']; ?>">
                </div>

                <div class="form-group">
                    <label>Tình trạng</label><br>
                    <input type="text" name="status" class="form-control" value="<?php echo $row_up['tinhTrang']; ?>">
                </div>

                <div class="form-group">
                    <label>Số lượng máy</label> <br>
                    <input type="number" name="numberComputer" value="<?php echo $row_up['soLuongMay']; ?>">
                </div>
                <button name="sbm" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>
</div>