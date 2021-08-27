<?php
try{
    $sqlBase = "SELECT * FROM giaovien";
	if (isset($_POST['sbm']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM giaovien WHERE nameGiaoVien LIKE '%$search%'";
    $query = mysqli_query($connect, $sql);
    $total_subject = mysqli_num_rows($query);
	} else {
    	$sql = $sqlBase;
		$query = mysqli_query($connect, $sql);
	}
	if (isset($_POST['sort'])) {
        $sql = $sqlBase + 'ORDER BY nameGiaoVien DESC';
        $query = mysqli_query($connect, $sql);
    }

	if (isset($_POST['all_subject'])) {
		unset($_POST['sbm']);
	}	
}catch (Exception $err) {
    echo 'lỗi rồi';
}

?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Danh sách giáo viên</h2>
            <form method="POST" class="d-flex" action="">
                <input name="search" type="search" class="form-control">
                <button name="sbm" class="btn btn-success">Tìm kiếm</button>
            </form>
        </div>

        <div class="card-body">
            <?php
            if (isset($total_subject)) {
                if ($total_subject !== 0) {
                    echo "<p class='text-success'>Tìm thấy $total_subject giáo viên</p>";
                } else {
                    echo "<p class='text-danger'> Không tìm thấy giáo viên nào! </p>";
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
                        <button name="all_subject" class='btn btn-success text-light'>Tất cả giáo viên</button>
                    </form>
                <?php } ?>
            </div>
			
            <table class="table bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã giáo viên</th>
                        <th>Tên giáo viên</th>
                        <th>Điện thoại </th>
                        <th>Email</th>
                        <th>Mật khẩu</th>
                        <th>Mã chức vụ</th>
                        <th width="12%">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['idGiaoVien']; ?></td>
                            <td> <?php echo $row['nameGiaoVien']; ?></td>
                            <td><?php echo $row['phoneGiaoVien']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['matKhau']; ?></td>
                            <td><?php echo $row['idChucVu']; ?></td>
                            <td>
                                <a class="btn btn-warning" href="index.php?page_layout=sua&id=<?php echo $row['idGiaoVien']; ?>">Sửa</a>
                                <a onclick="return Del('<?php echo $row['nameGiaoVien']; ?>')" class="btn btn-danger" href="index.php?page_layout=xoa&id=<?php echo $row['idGiaoVien']; ?>">Xóa</a>
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