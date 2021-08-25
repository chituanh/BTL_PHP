<?php
require_once 'config/db.php';
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
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'show':
                require_once 'Subject/show.php';
                break;

            case 'add':
                require_once 'Subject/add.php';
                break;

            case 'update':
                require_once 'Subject/update.php';
                break;

            case 'delete':
                require_once 'Subject/delete.php';
                break;

            default:
                require_once 'Subject/show.php';
                break;
        }
    } else {
        require_once 'Subject/show.php';
    }
    ?>
</body>

</html>