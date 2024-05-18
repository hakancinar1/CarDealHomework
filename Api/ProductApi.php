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

if ($_FILES['fileToUpload']) {
    if ($_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
        echo 'Dosya yükleme hatası: ';
        switch ($_FILES['fileToUpload']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo 'Dosya boyutu sunucu sınırını aşıyor.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo 'Dosya boyutu HTML form limitini aşıyor.';
                break;
            case UPLOAD_ERR_PARTIAL:
                echo 'Dosya yalnızca kısmen yüklendi.';
                break;
            case UPLOAD_ERR_NO_FILE:
                echo 'Dosya yüklenmedi.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo 'Geçici dizin bulunamadı.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo 'Disk yazma hatası.';
                break;
            case UPLOAD_ERR_EXTENSION:
                echo 'Dosya yükleme uzantısı tarafından durduruldu.';
                break;
            default:
                echo 'Bilinmeyen bir hata oluştu.';
                break;
        }
        die();
    }

    $fileName = $_FILES['fileToUpload']['name'];
    $fileTmp = $_FILES['fileToUpload']['tmp_name'];

    $uploadDirectory = 'uploads/';

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); 
    }

    $targetFile = $uploadDirectory . basename($fileName);

    if (move_uploaded_file($fileTmp, $targetFile)) {
        $carName = $_POST['CarName'];
        $filePath = $targetFile;

    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
    }
}

?>