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
    $dateStart = new DateTime('NOW');
    $dateEnd = (new DateTime('NOW'))->add(new DateInterval('P20D'));
} catch (Exception $err) {
    echo 'lỗi rồi';
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Thời Khóa Biểu</h2>
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
            <tr>
                <div class="card-footer d-flex justify-content-around">

                    <label>Thời gian bắt đầu</label>
                    <div class="form-group">

                        <input type="date" name="txtDateStart" class="form-control" value="<?php echo $dateStart->format('Y-m-d'); ?>">
                    </div>
                    <label>Thời gian kết thúc</label>
                    <div class="form-group">

                        <input type="date" name="txtDateEnd" class="form-control" value="<?php echo $dateEnd->format('Y-m-d'); ?>">
                    </div>
                    <a href="index.php?page_layout=them" class="btn btn-primary">
                        Thêm lịch trực
                    </a>
                </div>
            </tr>

            <table class="table bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Thứ</th>
                        <th>Ngày</th>
                        <th>Sáng</th>
                        <th>Chiều</th>
                        <th>Tối</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 0;
                    $interval = DateInterval::createFromDateString('1 day');
                    $period = new DatePeriod($dateStart, $interval, $dateEnd);
                    foreach ($period as $dt) { ?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $dt->format('l'); ?> </td>
                            <td><?php echo $dt->format('d-m-Y'); ?> </td>
                            <td></td>
                            <td></td>
                            <td></td>
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