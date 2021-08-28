<?php
$id = $_GET['id'];

$sql_teacher = "SELECT * FROM giaovien";
$query_teacher = mysqli_query($connect, $sql_teacher);

$sql_PM = "SELECT * FROM phongmay WHERE tinhTrang = 'hoạt động'";
$query_PM = mysqli_query($connect, $sql_PM);

$sql_up = "SELECT * FROM lichtruc
			INNER JOIN giaovien ON lichtruc.idGiaoVien = giaovien.idGiaoVien
			INNER JOIN phongmay ON lichtruc.idPhongMay = phongmay.idPhongMay 
			WHERE idLichTruc = $id";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);

if (isset($_POST['sbm'])) {
    $idGiaoVien = $_POST['idGiaoVien'];
	$timeStart = $_POST['timeStart'];
	$timeEnd = $_POST['timeEnd'];
    $idPhongMay = $_POST['idPhongMay'];
//    $requireComputer = $_POST['requireComputer'];
//    $idTeacher = $_POST['idGiaoVien'];

    $sql = "UPDATE lichtruc SET idGiaoVien  = '$idGiaoVien', idPhongMay = '$idPhongMay', timeStart = '$timeStart', timeEnd = '$timeEnd' WHERE idLichTruc = $id";
    $query = mysqli_query($connect, $sql);
    header('location: index.php');
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Chỉnh sửa phân công</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Giáo viên</label>
					<select class="form-control" name="idGiaoVien">
                        <?php
                        while ($row_teacher = mysqli_fetch_assoc($query_teacher)) { ?>
                            <option <?php if ($row_teacher['idGiaoVien'] == $row_up['idGiaoVien']) echo "selected"; ?> value="<?php echo $row_teacher['idGiaoVien']; ?>"><?php echo $row_teacher['nameGiaoVien']; ?></option>
                        <?php } ?>
                    </select>
                </div>
				
				
                
				<div class="form-group">
                    <label>Thời gian bắt đầu</label>
                  <input readonly type="datetime" name="timeStart" class="form-control" value="<?php echo $row_up['timeStart']; ?>">
                </div>
				
				<div class="form-group">
                    <label>Thời gian kết thúc</label>
                  <input readonly  type="datetime" name="timeEnd" class="form-control" value="<?php echo $row_up['timeEnd']; ?>">
                </div>

                <div class="form-group">
                    <label>Phòng máy</label>
                  <select class="form-control" name="idPhongMay">
                        <?php
                        while ($row_PM = mysqli_fetch_assoc($query_PM)) { ?>
                            <option <?php if ($row_PM['idPhongMay'] == $row_up['idPhongMay']) echo "selected"; ?> value="<?php echo $row_PM['idPhongMay']; ?>"><?php echo $row_PM['namePhongMay']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success">Cập nhật</button>
            </form>
        </div>
    </div>
</div>