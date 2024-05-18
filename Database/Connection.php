<?php

function _ConnectDB()
{
    $_db_servername = "sql208.infinityfree.com";
    $_db_username = "if0_36572271";
    $_db_password = "112233hbjkh";
    $_db_database = "if0_36572271_dbcardeal";

    $conn = new mysqli($_db_servername, $_db_username, $_db_password, $_db_database);

    if ($conn->connect_error) {
        die("hata : " . $conn->connect_error);

    }
    return $conn;
}

?>