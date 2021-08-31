<?php
require_once '../BTL_PHP/config/db.php';

$sqlHoatDong = "SELECT * FROM maytinh WHERE tinhTrang = 'hoạt động'";
$sqlAll = "SELECT * FROM maytinh";
$sqlBaoTri = "SELECT * FROM maytinh WHERE tinhTrang = 'bảo trì'";

$queryHoatDong = mysqli_query($connect, $sqlHoatDong);

$queryBaoTri = mysqli_query($connect, $sqlBaoTri);

$queryAll = mysqli_query($connect, $sqlAll);

$all = $queryAll->num_rows;

$baoTri = intval(($queryBaoTri->num_rows) / $all);
$hoatDong = intval(($queryHoatDong->num_rows) / $all);
$hong = 100 - $baoTri - $hoatDong;


?>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Hoạt Động", "Bảo Trì", "Hỏng"],
      datasets: [{
        data: [<?php echo $hoatDong ?>, <?php echo $baoTri ?>, <?php echo $hong ?>],
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>