<?php
// データベース接続情報
$host = 'localhost';
$dbname = 'test_db';
$username = 'root';
$password = '';

try {
    // PDOを使った接続
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームから送信されたデータを取得
    $name = $_POST['name'];
    $email = $_POST['email'];

    // SQLの実行
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo "ユーザー情報を登録しました。";
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>
