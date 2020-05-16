<?php
    $mysqli = new mysqli("localhost", "root", "", "laba7");

    if ($mysqli->connect_errno) {
        echo "Не удалось подключится к MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
    } else {
        $visitorIp = $_SERVER['REMOTE_ADDR'];
        $visitDate = date("Y-m-d");
        $page = basename($_SERVER["PHP_SELF"]);

        $query = "INSERT INTO visits VALUES(NULL, '$page', '$visitDate', '$visitorIp')";
        $mysqli->query($query);
        if ($mysqli->errno) {
            echo "Не удалось занести данные в таблицу: (" . $mysqli->errno . ")" . $mysqli->error;
        }
    }
?>