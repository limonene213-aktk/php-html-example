<?php
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadedFileName = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/" . $uploadedFileName);
    echo "ファイル " . htmlspecialchars($uploadedFileName, ENT_QUOTES, 'UTF-8') . " をアップロードしました。";
} else {
    echo "ファイルのアップロードに失敗しました。";
}
?>
