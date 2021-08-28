<?php
try{
    $sqlBase = "SELECT lichtruc.idGiaoVien, nameGiaoVien, phoneGiaoVien, email, SUM(HOUR(TIMEDIFF(timeEnd, timeStart))*60 + MINUTE(TIMEDIFF(timeEnd, timeStart))  ) AS cong  				FROM lichtruc
				INNER JOIN giaovien ON lichtruc.idGiaoVien = giaovien.idGiaoVien
				GROUP BY idGiaoVien";
	
	if (isset($_POST['sbm']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql =  "SELECT lichtruc.idGiaoVien, nameGiaoVien, phoneGiaoVien, email, SUM(HOUR(TIMEDIFF(timeEnd, timeStart))*60 + MINUTE(TIMEDIFF(timeEnd, timeStart))  ) AS cong  	 				FROM lichtruc
				INNER JOIN giaovien ON lichtruc.idGiaoVien = giaovien.idGiaoVien
				WHERE nameGiaoVien LIKE '%$search%'";
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
            <h2>Bảng tính công</h2>
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
				<a href="index.php?page_layout=danhsach" class="btn btn-primary">
                    Quay lại
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
                        <th>Tên giáo viên</th>
                        <th>Điện thoại </th>
                        <th>Email </th>
                        <th>Số công</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td> <?php echo $row['nameGiaoVien']; ?></td>
                            <td><?php echo $row['phoneGiaoVien']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo round( ($row['cong']/8/60), 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

       
    </div>
</div>

<script>
    function Del(name, time) {
        return confirm("Bạn có chắc chắn muốn xóa nhân viên: " + name + " trực ngày "+time+" ?");
    }
</script>