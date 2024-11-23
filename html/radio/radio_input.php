<?php
$gender = $_POST['gender'];
echo "選択された性別: " . htmlspecialchars($gender, ENT_QUOTES, 'UTF-8');
?>
