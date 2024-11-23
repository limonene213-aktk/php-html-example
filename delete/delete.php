<?php
// データベース接続情報
$host = 'localhost';
$dbname = 'test_db';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // PDOを使った接続
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // フォームから送信されたIDを取得
        $id = $_POST['id'];

        // データを削除
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "ユーザーを削除しました。";
    } catch (PDOException $e) {
        echo "データベースエラー: " . $e->getMessage();
    }
    exit;
}

// ユーザー一覧の取得
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー削除</title>
</head>
<body>
    <h1>ユーザー削除</h1>
    <form action="delete.php" method="post">
        <label for="id">削除するユーザーID:</label>
        <select id="id" name="id">
            <?php foreach ($users as $user): ?>
            <option value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($user['id'] . ': ' . $user['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">削除</button>
    </form>
    <a href="/">TOPに戻る</a>
</body>
</html>
