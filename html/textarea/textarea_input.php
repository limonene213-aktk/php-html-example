<?php
$comment = $_POST['comment'];
echo "入力されたコメント: " . nl2br(htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'));
?>
