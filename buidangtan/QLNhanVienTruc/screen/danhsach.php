<?php
try{
    $sqlBase = "SELECT * FROM lichtruc
				INNER JOIN giaovien ON lichtruc.idGiaoVien = giaovien.idGiaoVien 
				INNER JOIN phongmay ON lichtruc.idPhongMay = phongmay.idPhongMay ";
	
	if (isset($_POST['sbm']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT lichtruc.idGiaoVien, nameGiaoVien, phoneGiaoVien, email, timeStart, timeEnd, lichtruc.idPhongMay, namePhongMay FROM lichtruc 
				INNER JOIN giaovien ON lichtruc.idGiaoVien = giaovien.idGiaoVien 
				INNER JOIN phongmay ON lichtruc.idPhongMay = phongmay.idPhongMay 
				WHERE nameGiaoVien LIKE '%$search%'";
		
    $query = mysqli_query($connect, $sql);
		
    $total_subject = mysqli_num_rows($query);
		
	} else {
    	$sql = $sqlBase;
		$query = mysqli_query($connect, $sql);
	}
	if (isset($_POST['sort'])) {
        $sql = "SELECT * FROM lichtruc
				INNER JOIN giaovien ON lichtruc.idGiaoVien = giaovien.idGiaoVien
				INNER JOIN phongmay ON lichtruc.idPhongMay = phongmay.idPhongMay 
				ORDER BY nameGiaoVien DESC";
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
            <h2>Danh sách nhân viên trực</h2>
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
				
				 <a href="index.php?page_layout=tinhcong" class="btn btn-primary">
                    Tính công
                </a>

<!--
                
-->
            </div>
			
            <table class="table bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã giáo viên</th>
                        <th>Tên giáo viên</th>
                        <th>Điện thoại </th>
                        <th>Email</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
						<th>Phòng máy</th>
                        <th width="12%">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['idGiaoVien']; ?></td>
                            <td> <?php echo $row['nameGiaoVien']; ?></td>
                            <td><?php echo $row['phoneGiaoVien']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['timeStart']; ?></td>
                            <td><?php echo $row['timeEnd']; ?></td>
                            <td><?php echo $row['namePhongMay']; ?></td>
                            <td>
                                <a class="btn btn-warning" href="index.php?page_layout=sua&id=<?php echo $row['idLichTruc']; ?>">Sửa</a>
                                <a onclick="return Del('<?php echo $row['nameGiaoVien'] ?>','<?php echo $row['timeStart'] ?>')" class="btn btn-danger" href="index.php?page_layout=xoa&id=<?php echo $row['idLichTruc']; ?>">Xóa</a>
                            </td>
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