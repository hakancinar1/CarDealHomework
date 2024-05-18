<?php
header("Access-Control-Allow-Origin: *"); // * yerine belirli bir domain de yazabilirsiniz örneğin: http://dealer.rf.gd
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// OPTIONS isteğini ele almak
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}
include ("../Database/CrudProccessor.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = CreatedUsers($username, $password);
    if ($result) {
        $response = array(
            'success' => true,
            'message' => 'Success'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error. Check the given informations!'
        );
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