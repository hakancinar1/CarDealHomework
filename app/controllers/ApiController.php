<?php
class ApiController  {
    public function index() {
        header("Access-Control-Allow-Origin: *"); 
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // OPTIONS isteğini ele almak
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            http_response_code(200);
            exit;
        }
        $_CrudServices = CrudServices::getInstance();   
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // İstek işlemlerini al
            $data = json_decode(file_get_contents('php://input'), true);
            $method = $data['method'] ?? '';
            
            // İstenen işlemi gerçekleştir
            switch ($method) {
                case 'login':
                    $username = $data['username'];
                    $password = $data['password'];
                    $checkUser = $_CrudServices->checkUser($username, $password);
                    if ($checkUser) {
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
                    break;
                case 'register':
                    $username = $data['username'];
                    $password = $data['password'];
                    $result =$_CrudServices->createUser($username, $password);
                    if ($result) {
                        $response = array(
                            'success' => true,
                            'message' => 'Kullanıcı oluşturuldu'
                        );
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Hata. Verilen bilgileri kontrol edin!'
                        );
                    }
                    break;
                case 'createContact':
                    
                    $username = $data['username'];
                    $message = $data['message'];
                    $result = $_CrudServices->createContact($username, $message);
                    if ($result) {
                        $response = array(
                            'success' => true,
                            'message' => 'Mesaj Alındı'
                        );
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Hata. Verilen bilgileri kontrol edin!'
                        );
                    }
                    break;

                case 'getContactList':
                    
                    $result = $_CrudServices->getContactList();
                    if ($result) {
                        $response = array(
                            'success' => true,
                            'message' => $result
                        );
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Hata. Veritabanında kayıt bulunamadı!'
                        );
                    }
                    break;

                default:
                    $response = array(
                        'success' => null,
                        'message' => 'Geçersiz yöntem!='.$data
                    );
                    break;
            }
        } else {
            $response = array(
                'success' => false,
                'message' => 'Yanlış istek methodu. Sadece POST istekleri kabul edilir.'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        
    }
}
?>