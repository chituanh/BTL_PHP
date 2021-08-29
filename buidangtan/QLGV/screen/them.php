<?php
$sql_teacher = "SELECT * FROM chucvu";
$query_teacher = mysqli_query($connect, $sql_teacher);

if (isset($_POST['sbm'])) {
    $nameGV = $_POST['nameGV'];
    $phoneGV = $_POST['phoneGV'];
    $email = $_POST['email'];
    $idCV = $_POST['idCV'];

    $sql = "INSERT INTO giaovien(nameGiaoVien, phoneGiaoVien, email, matKhau, idChucVu) VALUES('$nameGV', '$phoneGV', '$email', '1234', $idCV)";

    $query = mysqli_query($connect, $sql);
    echo "<script>";
    echo "location.href='index.php'";
    echo "</script>";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm giáo viên</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên giáo viên</label>
                    <input type="text" name="nameGV" class="form-control">
                </div>

                <div class="form-group">
                    <label>Điện thoại</label> <br>
                    <input type="text" name="phoneGV">
                </div>

                <div class="form-group">
                    <label>Email</label><br>
                    <input type="text" name="email">
                </div>


                <div class="form-group">
                    <label>Chức vụ</label>
                    <select class="form-control" name="idCV">
                        <?php
                        while ($row_teacher = mysqli_fetch_assoc($query_teacher)) { ?>
                            <option value="<?php echo $row_teacher['idChucVu']; ?>"><?php echo $row_teacher['nameChucVu']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>