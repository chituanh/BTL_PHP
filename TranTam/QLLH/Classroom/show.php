<?php
if (isset($_POST['sbm']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM phongmay WHERE namePhongMay LIKE '%$search%'";
    $query = mysqli_query($connect, $sql);
    $total_class = mysqli_num_rows($query);
} else {
    $sql = "SELECT * FROM phongmay";
    $query = mysqli_query($connect, $sql);
}

if (isset($_POST['all_class'])) {
    unset($_POST['sbm']);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Danh sách phòng học</h2>
            <form method="POST" class="d-flex" action="">
                <input name="search" type="search" class="form-control">
                <button name="sbm" class="btn btn-success">Tìm kiếm</button>
            </form>
        </div>

        <div class="card-body">
            <?php
            if (isset($total_class)) {
                if ($total_class !== 0) {
                    echo "<p class='text-success'>Tìm thấy $total_class phòng học</p>";
                } else {
                    echo "<p class='text-danger'> Không tìm thấy phòng học nào! </p>";
                }
            }
            ?>
            <table class="table bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã phòng học</th>
                        <th>Tên phòng học</th>
                        <th>Tình trạng</th>
                        <th>Số lượng máy</th>
                        <th width="12%">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></th>
                            <td><?php echo $row['namePhongMay']; ?></td>
                            <td> <?php echo $row['tinhTrang']; ?></td>
                            <td><?php echo $row['soLuongMay']; ?></td>

                            <td>
                                <a class="btn btn-warning" href="index.php?action=update&id=<?php echo $row['idPhongMay']; ?>">Sửa</a>
                                <a onclick="return Del('<?php echo $row['namePhongMay']; ?>')" class="btn btn-danger" href="index.php?action=delete&id=<?php echo $row['idPhongMay']; ?>">Xóa</a>
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
                    <button name="all_class" class='btn btn-success text-light'>Tất cả phòng học</button>
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