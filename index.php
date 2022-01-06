<?php

require_once __DIR__ . '/vendor/autoload.php';

if (isset($_GET["conf"])) {
    $conf = filter_var($_GET["conf"], FILTER_SANITIZE_STRING);
    $conf = rtrim($conf, "/");
    $conf = explode("/", $conf);
    if ($conf[0] == "api") {
        unset($conf[0]);
        if (isset($conf[1])) {
            $faker = Faker\Factory::create($conf[1]);
        } else {
            $faker = Faker\Factory::create();
        }
        $data = array(
            "name" => $faker->name,
            "address" => $faker->address,
            "email" => $faker->username . "@" . $faker->freeEmailDomain,
            "ipv4" => $faker->ipv4,
            "userAgent" => $faker->userAgent
        );
        header("Content-Type: application/json");
        $data = json_encode($data, JSON_PRETTY_PRINT);
        echo $data;
        die;
    }
    $faker = Faker\Factory::create($conf[0]);
} else {
    $faker = Faker\Factory::create();
}

$data = array(
    "name" => $faker->name,
    "address" => $faker->address,
    "email" => $faker->username . "@" . $faker->freeEmailDomain,
    "ipv4" => $faker->ipv4,
    "userAgent" => $faker->userAgent
);
$data = json_encode($data, JSON_PRETTY_PRINT);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Faker GUI &ndash; Fadjrir Herlambang</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<style>
body {
    font-family: 'Open Sans', sans-serif;
}

.card {
    width: 480px;
}

.list-group-item {
    font-size: 13px;
}
</style>

<body class="bg-light">
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <h3>Faker GUI</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4 d-flex justify-content-center">
                <div class="card border-0 text-center align-middle">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item fs-4"><?= json_decode($data)->name ?></li>
                            <li class="list-group-item"><?= json_decode($data)->address ?></li>
                            <li class="list-group-item"><?= json_decode($data)->email ?></li>
                            <li class="list-group-item"><?= json_decode($data)->ipv4 ?> </li>
                            <li class="list-group-item"><?= json_decode($data)->userAgent ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-3">
                <p>
                    <a class="btn btn-sm btn-primary" href="#" role="button" id="refreshPage">Refresh</a>
                    <small><a class="text-decoration-none ms-2 fst-italic font-monospace" href="#collapseExample"
                            data-bs-toggle="collapse">View
                            JSON
                            Prettier</a></small>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="collapse" id="collapseExample">
                    <div class="card bg-dark text-white border-0">
                        <div class="card-body">
                            <pre><?= $data ?></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelector("#refreshPage").addEventListener("click", function() {
        location.reload();
    });
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="./assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>