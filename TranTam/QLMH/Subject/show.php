<?php
if (isset($_POST['sbm']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM monhoc INNER JOIN giaovien ON monhoc.idGiaoVien = giaovien.idGiaoVien WHERE nameMonHoc LIKE '%$search%'";
    $query = mysqli_query($connect, $sql);
    $total_subject = mysqli_num_rows($query);
} else {
    $sql = "SELECT * FROM monhoc inner join giaovien on monhoc.idGiaoVien = giaovien.idGiaoVien";
    $query = mysqli_query($connect, $sql);
}

if (isset($_POST['all_subject'])) {
    unset($_POST['sbm']);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Danh sách môn học</h2>
            <form method="POST" class="d-flex" action="">
                <input name="search" type="search" class="form-control">
                <button name="sbm" class="btn btn-success">Tìm kiếm</button>
            </form>
        </div>

        <div class="card-body">
            <?php
            if (isset($total_subject)) {
                if ($total_subject !== 0) {
                    echo "<p class='text-success'>Tìm thấy $total_subject môn học</p>";
                } else {
                    echo "<p class='text-danger'> Không tìm thấy môn học nào! </p>";
                }
            }
            ?>
            <table class="table bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã môn học</th>
                        <th>Tên Môn học</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Số tiết</th>
                        <th>Yêu cầu phòng máy</th>
                        <th>Giáo viên</th>
                        <th width="12%">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></th>
                            <td><?php echo $row['nameMonHoc']; ?></td>
                            <td> <?php echo $row['ngayBatDau']; ?></td>
                            <td><?php echo $row['ngayKetThuc']; ?></td>
                            <td><?php echo $row['soTiet']; ?></td>
                            <td><?php echo $row['yeuCauPhongMay']; ?></td>
                            <td><?php echo $row['nameGiaoVien']; ?></td>
                            <td>
                                <a class="btn btn-warning" href="index.php?action=update&id=<?php echo $row['idMonHoc']; ?>">Sửa</a>
                                <a onclick="return Del('<?php echo $row['nameMonHoc']; ?>')" class="btn btn-danger" href="index.php?action=delete&id=<?php echo $row['idMonHoc']; ?>">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="index.php?action=add" class="btn btn-primary">
                Thêm mới
            </a>

            <?php
            if (isset($_POST['sbm']) && !empty($_POST['search'])) { ?>
                <form method="POST" action="">
                    <button name="all_subject" class='btn btn-success text-light'>Tất cả môn học</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    function Del(name) {
        return confirm("Bạn có chắc chắn muốn xóa: " + name + " ?");
    }
</script>