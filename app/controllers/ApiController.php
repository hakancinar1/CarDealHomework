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

        // Hata ayıklama için gelen veriyi kontrol edin
        $rawData = file_get_contents('php://input');
        error_log("Raw Data: " . $rawData);
        
        $data = json_decode($rawData, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON Decode Error: " . json_last_error_msg());
            $response = array(
                'success' => false,
                'message' => 'Geçersiz JSON verisi.'
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        
        $_CrudServices = CrudServices::getInstance();   
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // İstek işlemlerini al
            
            $method = $data['method'] ?? '';
            
            // İstenen işlemi gerçekleştir
            switch ($method) {
                case 'login':
                    $username = $data['username'];
                    $password = $data['password'];
                    $checkUser = $_CrudServices->checkUser($username, $password);
                    if ($checkUser) {
                        $token = $this->generateToken($username);
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
                    break;

                case 'logout':
                    $this->Logout();
                    $response = array(
                        'success' => true,
                        'message' => 'Logout success'
                    );
                   
                    
                    
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
                        'message' => $data
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
    public  function generateToken($username) {
        
        $key = "burasiAnahatar055635";

        $tokenData = array(
            "username" => $username,
            "timestamp" => time() 
        );
    
    
        $token = $this->jwt_encode_encode($tokenData, $key);
    
        return $token;
    }
    public function  jwt_encode_encode($data, $key)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($data);

        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }
    public function  base64UrlEncode($data)
    {
        $base64 = base64_encode($data);
        if ($base64 === false) {
            return false;
        }
        $base64Url = strtr($base64, '+/', '-_');
        return rtrim($base64Url, '=');
    }
    public function Logout() {

        session_start();

        $_SESSION = array();

        session_destroy();
        
        



    }
}
?>