<?php

$sqlPhongMay = "SELECT * FROM phongmay";
$queryPhongMay = mysqli_query($connect, $sqlPhongMay);


if (isset($_POST['sbm'])) {
    $nameMayTinh = $_POST['txtNameMayTinh'];
    $cauHinhMay = $_POST['txtCauHinhMay'];
    $phanCung = $_POST['txtPhanCung'];
    $idPhongMay = $_POST['sePhongMay'];
    $tinhTrang = $_POST['seTinhTrang'];
    if (trim($nameMayTinh, ' ') == '' || trim($cauHinhMay, ' ') == '' || trim($phanCung) == '') {
    } else {
        $sql = "INSERT INTO `maytinh`(`idMayTinh`, `tinhTrang`, `cauHinhMay`, `phanCung`, `idPhongMay`, `nameMayTinh`) VALUES (NULL , '$tinhTrang' ,  '$cauHinhMay', '$phanCung' , $idPhongMay ,'$nameMayTinh')";
        $query = mysqli_query($connect, $sql);
    }
    echo "<script>";
    echo "location.href='index.php'";
    echo "</script>";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Thêm Máy Tính</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên máy tính</label>
                    <input type="text" name="txtNameMayTinh" class="form-control">
                </div>

                <div class="form-group">
                    <label>Cấu hình máy</label>
                    <input type="text" name="txtCauHinhMay" class="form-control">
                </div>

                <div class="form-group">
                    <label>Phần cứng</label>
                    <input type="text" name="txtPhanCung" class="form-control">
                </div>

                <div class="form-group">
                    <label>Phòng Máy</label>
                    <select name="sePhongMay" class="form-select form-control" aria-label="Default select example">
                        <?php
                        while ($row = mysqli_fetch_assoc($queryPhongMay)) { ?>
                            <option value="<?php echo $row['idPhongMay']; ?>"> <?php echo  $row['namePhongMay'];  ?> </option>
                        <?php }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tình Trạng</label>
                    <select name="seTinhTrang" class="form-select form-control" aria-label="Default select example">
                        <option value="hoạt động"> Hoạt Động </option>
                        <option value="bảo trì"> Bảo Trì </option>
                        <option value="hỏng"> Hỏng </option>
                    </select>
                </div>

                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>