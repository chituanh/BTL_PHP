<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }

    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }

    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }

    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>


<?php
session_start();
$isError = false;
if (isset($_POST['username']))
    $username = $_POST['username'];
if (isset($_POST['password']))
    $password = $_POST['password'];
if (isset($_POST['submit'])) {

    require_once './config/db.php';
    try {
        $sql = "SELECT * FROM giaovien WHERE email = '" . $username . "' AND matKhau = '" . $password . "'";
        $query = mysqli_query($connect, $sql);
        if ($query->num_rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $row = mysqli_fetch_assoc($query);
            $_SESSION['idUser'] = $row['idGiaoVien'];
            $_SESSION['isDangNhap'] = true;
            $isError = false;

            header('location: ./home/index.php');
        } else {
            $isError = true;
        }
        unset($_POST['submit']);
    } catch (Exception $err) {
    }
}
?>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" value="" class="form-control">
                            </div>
                            <div class="form-group justify-content-center align-items-center" style="text-align: center;">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div class="form-group justify-content-center align-items-center" style="text-align: center;">
                                <?php if ($isError == true) { ?> <table>Tài khoản hoặc mật khẩu không đúng</table> <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>