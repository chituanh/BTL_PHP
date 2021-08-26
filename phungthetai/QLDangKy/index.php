<?php
try {
    require_once '../../config/db.php';
} catch (Exception $err) {
    echo 'lỗi rồi';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        label {
            font-weight: 500;
        }

        .card input[type="search"] {
            margin-right: -6px;
        }

        .card input[type="search"]:focus,
        .card-header button:focus {
            box-shadow: none !important;
        }

        .card-header button {
            width: 140px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
    <title>CRUD PHP</title>
</head>

<body>
    <?php
    if (isset($_GET['page_layout'])) {
        switch ($_GET['page_layout']) {
            case 'danhsach':
                require_once 'screens/list_dang_ky.php';
                break;

            case 'them':
                require_once 'screens/add_dang_ky.php';
                break;

            case 'sua':
                require_once 'screens/repair_dang_ky.php';
                break;

            case 'xoa':
                require_once 'screens/del_dang_ky.php';
                break;

            default:
                require_once 'screens/list_dang_ky.php';
                break;
        }
    } else {
        require_once 'screens/list_dang_ky.php';
    }
    ?>
</body>

</html>