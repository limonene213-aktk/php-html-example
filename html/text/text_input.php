<?php
$name = $_POST['name'];
echo "こんにちは、" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "さん！";
?>
