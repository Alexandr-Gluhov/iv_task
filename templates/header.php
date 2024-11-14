<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Поликлиника</title>
    <link href="/iv_task/inc/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="shadow-sm w-100">
        <div class="container p-3">
            <div class="row">
                <div class="col display-5">
                    <img src="/iv_task/inc/img/logo.png" width="50">
                    Областная поликлиника
                </div>
                <div class="col text-end">

                    <?php
                    include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/auth_bock.php');
                    ?>

                </div>
            </div>
        </div>
    </header>