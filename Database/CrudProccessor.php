<?php

include ("Connection.php");
function CreatedUsers($user_name, $user_password)
{
    //conn
    $query = "INSERT INTO `TBUsers` (`ID`, `UserName`, `UserPwd`) VALUES (NULL, '" . $user_name . "', '" . $user_password . "') ";
    $connect = _ConnectDB();
    $result = $connect->prepare($query);
    if ($result->execute() == TRUE) {
        $connect->close();
        return true;
    }
    $connect->close();
    return false;
}

function CheckUsers($user_name, $user_password)
{
    //conn
    $query = " SELECT * FROM TBUsers WHERE UserName ='" . $user_name . "' and UserPwd = '" . $user_password . "' ";

    $connect = _ConnectDB();
    $result = $connect->query($query);



    if ($result->num_rows > 0) {
        $connect->close();
        return true;
    }
    $connect->close();
    return false;
}

function CreateContacts($user_name, $user_message)
{
    //conn
    $query = "INSERT INTO `TBContacts` (`ID`, `ContactName`, `ContactMessage`) VALUES (NULL, '" . $user_name . "', '" . $user_message . "')";
    $connect = _ConnectDB();
    $result = $connect->prepare($query);
    if ($result->execute() == TRUE) {
        $connect->close();
        return true;
    }
    $connect->close();
    return false;
}

function ContactList()
{
    //conn
    $query = " SELECT * FROM TBContacts ORDER BY ID DESC  ";

    $connect = _ConnectDB();
    $result = $connect->query($query);



    if ($result->num_rows > 0) {
        $rows = $result->fetch_all();
        $connect->close();
        return $rows;
    }
    $connect->close();
    return null;
}

function CreateProducts($CarName, $ImagePath)
{
    //conn
    $query = "INSERT INTO `TBProducts` (`ID`, `CarName`, `ImagePath`) VALUES (NULL, '" . $CarName . "', '" . $ImagePath . "')";
    $connect = _ConnectDB();
    $result = $connect->prepare($query);
    if ($result->execute() == TRUE) {
        $connect->close();
        return true;
    }
    $connect->close();
    return false;
}

?>