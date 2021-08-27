<?php
$id = $_GET['id'];

$sql_teacher = "SELECT * FROM chucvu";
$query_teacher = mysqli_query($connect, $sql_teacher);

$sql_up = "SELECT * FROM giaovien WHERE idGiaoVien = $id";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);

if (isset($_POST['sbm'])) {
    $nameGV = $_POST['nameGV'];
    $phoneGV = $_POST['phoneGV'];
    $email = $_POST['email'];
    $idCV = $_POST['idChucVu'];
//    $requireComputer = $_POST['requireComputer'];
//    $idTeacher = $_POST['idGiaoVien'];

    $sql = "UPDATE giaovien SET namegiaovien  = '$nameGV', phoneGiaoVien = '$phoneGV', email = '$email', idChucVu = $idCV WHERE idGiaoVien = $id";
    $query = mysqli_query($connect, $sql);
    header('location: index.php');
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Sửa giáo viên</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên giáo viên</label>
                    <input type="text" name="nameGV" class="form-control" value="<?php echo $row_up['nameGiaoVien']; ?>">
                </div>
				
				<div class="form-group">
                    <label>Điện thoại</label>
                  <input type="text" name="phoneGV" class="form-control" value="<?php echo $row_up['phoneGiaoVien']; ?>">
                </div>
				<div class="form-group">
                    <label>Email</label>
                  <input type="text" name="email" class="form-control" value="<?php echo $row_up['email']; ?>">
                </div>
                

                <div class="form-group">
                    <label>Chức vụ</label>
                  <select class="form-control" name="idChucVu">
                        <?php
                        while ($row_teacher = mysqli_fetch_assoc($query_teacher)) { ?>
                            <option <?php if ($row_teacher['idChucVu'] == $row_up['idChucVu']) echo "selected"; ?> value="<?php echo $row_teacher['idChucVu']; ?>"><?php echo $row_teacher['nameChucVu']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success">Cập nhật</button>
            </form>
        </div>
    </div>
</div>