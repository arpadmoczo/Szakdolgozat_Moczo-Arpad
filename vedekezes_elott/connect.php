<?php
        $database = 'login_neobank';

        $connection = mysqli_connect(
            "127.0.0.1",
            "root",
            ""
        );

        $connection->set_charset("utf8");

        if (!$connection) {
            die("Nem lehet csatlakozni a MySQL
        kiszolgálóhoz! " . mysqli_error());
        }

        mysqli_select_db($connection, $database)
            or die("Nem lehet megnyitni a következő adatbázist:
        $database" . mysqli_error());
?>
