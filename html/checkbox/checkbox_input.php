<?php
$fruits = $_POST['fruits'] ?? [];
if (empty($fruits)) {
    echo "何も選択されていません。";
} else {
    echo "選択されたフルーツ: " . htmlspecialchars(implode(', ', $fruits), ENT_QUOTES, 'UTF-8');
}
?>
