<?php
try {
    $sqlBase = "SELECT idMayTinh, nameMayTinh, phongmay.namePhongMay, cauHinhMay, phanCung, maytinh.tinhTrang FROM `maytinh` inner join phongmay on maytinh.idPhongMay = phongmay.idPhongMay";
    if (isset($_POST['sbm']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $sql = $sqlBase +  "WHERE nameMayTinh LIKE '%$search%' ";
        $query = mysqli_query($connect, $sql);
        $total_subject = mysqli_num_rows($query);
    } else {
        $sql = $sqlBase;
        $query = mysqli_query($connect, $sql);
    }
    if (isset($_POST['sort'])) {
        $sql = $sqlBase + 'ORDER BY nameMayTinh DESC';
        $query = mysqli_query($connect, $sql);
    }

    if (isset($_POST['all_subject'])) {
        unset($_POST['sbm']);
    }
} catch (Exception $err) {
    echo 'lỗi rồi';
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Danh sách Máy Tính</h2>
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
            <div class="card-footer d-flex justify-content-between">
                <a href="index.php?page_layout=them" class="btn btn-primary">
                    Thêm mới
                </a>

                <?php
                if (isset($_POST['sbm']) && !empty($_POST['search'])) { ?>
                    <form method="POST" action="">
                        <button name="all_subject" class='btn btn-success text-light'>Tất cả môn học</button>
                    </form>
                <?php } ?>
            </div>

            <table class="table bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã Máy Tính</th>
                        <th>Tên Máy Tính</th>
                        <th>Phòng Máy</th>
                        <th>Cấu Hình Máy</th>
                        <th>Phần Cứng</th>
                        <th>Tình Trạng</th>

                        <th width="12%">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr class="<?php if (++$i % 2 == 0) '.bg-light' ?>">
                            <td><?php echo $row['idMayTinh']; ?></th>
                            <td><?php echo $row['nameMayTinh']; ?></td>
                            <td> <?php echo $row['namePhongMay']; ?></td>
                            <td><?php echo $row['cauHinhMay']; ?></td>
                            <td><?php echo $row['phanCung']; ?></td>
                            <td>
                                <div class="<?php
                                            if ($row['tinhTrang'] == 'hoạt động') echo 'text-success';
                                            else if ($row['tinhTrang'] == 'bảo trì') echo 'text-warning';
                                            else if ($row['tinhTrang'] == 'hỏng') echo 'text-danger';
                                            ?>"><?php echo $row['tinhTrang']; ?></div>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="index.php?page_layout=sua&id='<?php echo $row['idMayTinh']; ?>'">Sửa</a>
                                <a onclick="return Del('<?php echo $row['nameMayTinh']; ?>')" class="btn btn-danger" href="index.php?page_layout=xoa&id='<?php echo $row['idMayTinh']; ?>'">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>
</div>

<script>
    function Del(name) {
        return confirm("Bạn có chắc chắn muốn xóa: " + name + " ?");
    }
</script>