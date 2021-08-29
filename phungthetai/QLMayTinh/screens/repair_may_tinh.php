<?php
$id = $_GET['id'];

$sqlPhongMay = "SELECT * FROM phongmay";
$queryPhongMay = mysqli_query($connect, $sqlPhongMay);

$sql_up = "SELECT * FROM maytinh WHERE idMayTinh = $id";
$query_up = mysqli_query($connect, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);



if (isset($_POST['sbm'])) {
    $nameMayTinh = $_POST['txtNameMayTinh'];
    $cauHinhMay = $_POST['txtCauHinhMay'];
    $phanCung = $_POST['txtPhanCung'];
    $idPhongMay = $_POST['sePhongMay'];
    $tinhTrang = $_POST['seTinhTrang'];

    try {
        $sql = "UPDATE `maytinh` SET `tinhTrang`= '$tinhTrang',`cauHinhMay`= '$cauHinhMay',`phanCung`='$phanCung',`idPhongMay`= $idPhongMay,`nameMayTinh`= '$nameMayTinh' WHERE idMayTinh = $id";
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
            <h2>Sửa Máy Tính</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên máy tính</label>
                    <input type="text" name="txtNameMayTinh" class="form-control" value="<?php echo $row_up['nameMayTinh']; ?>">
                </div>

                <div class="form-group">
                    <label>Cấu hình máy</label>
                    <input type="text" name="txtCauHinhMay" class="form-control" value="<?php echo $row_up['cauHinhMay']; ?>">
                </div>

                <div class="form-group">
                    <label>Phần cứng</label>
                    <input type="text" name="txtPhanCung" class="form-control" value="<?php echo $row_up['phanCung']; ?>">
                </div>


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
                    <label>Tình Trạng</label>
                    <select name="seTinhTrang" class="form-select form-control" aria-label="Default select example">
                        <option value="hoạt động" <?php if ($row_up['tinhTrang'] == 'hoạt động') echo 'selected' ?>>Hoạt Động</option>
                        <option value="bảo trì" <?php if ($row_up['tinhTrang'] == 'bảo trì') echo 'selected' ?>>Bảo Trì</option>
                        <option value="hỏng" <?php if ($row_up['tinhTrang'] == 'hỏng') echo 'selected' ?>>Hỏng</option>
                    </select>
                </div>
                <button name="sbm" class="btn btn-success ">Sửa</button>
            </form>
        </div>
    </div>
</div>