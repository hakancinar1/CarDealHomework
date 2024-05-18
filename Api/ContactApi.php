<?php

include ("../Database/CrudProccessor.php");

// CORS ayarları
header("Access-Control-Allow-Origin: *"); // * yerine belirli bir domain de yazabilirsiniz örneğin: http://dealer.rf.gd
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// OPTIONS isteğini ele almak
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $Route_Function = $_POST['method'];

    if ($Route_Function == "CREATE_001") {
        $username = $_POST['username'];
        $message = $_POST['message'];
        $result = CreateContacts($username, $message);
        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Message Recived'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error. Check the given informations!'
            );
        }
    }
    else if ($Route_Function == 'GETLIST') {

        $result = ContactList();
        if ($result) {
            $response = array(
                'success' => true,
                'message' => $result
            );
        } else {
            $response = array(
                'success' => false,
                'message' => $result
            );
        }
    }

} else {
    $response = array(
        'success' => false,
        'message' => 'Yanlış istek methodu. Sadece POST istekleri kabul edilir.'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>