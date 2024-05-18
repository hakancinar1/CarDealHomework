<?php
$key = "burasiAnahatar055635";
header("Access-Control-Allow-Origin: *"); // * yerine belirli bir domain de yazabilirsiniz örneğin: http://dealer.rf.gd
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// OPTIONS isteğini ele almak
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}
include ("../Function/CreateToken.php");
include ("../Database/CrudProccessor.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkUser = CheckUsers($username, $password);
    if ($checkUser) {
        $token = generateToken($username, $key);
        session_start();
        $_SESSION['token'] = $token;
        $_SESSION['username'] = $username;

        $response = array(
            'success' => true,
            'message' => 'Giriş başarılı! Hoş geldiniz, ' . $username
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Kullanıcı adı veya şifre yanlış.'
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