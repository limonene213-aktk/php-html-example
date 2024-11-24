# Webアプリを作るための基本的なPHPの使い方

## HTML入力フォームとPHP処理の例

このリポジトリでは、HTMLの主要な入力パーツを使用してPHPで処理を行うシンプルな例を紹介します。初心者が基本を学ぶための教材として役立つように設計されています。

## 前提条件

- <a href="https://www.apachefriends.org/jp/index.html">Xampp</a>などを使って**PHPが動作するウェブサーバー**と**SQLサーバー**を用意します。
- 必要に応じて、MySQLデータベースのセットアップも行います。
- すべてのコードは `UTF-8` を前提としています。
- HTMLそのものに不安や不明点がある場合は、<a href="https://developer.mozilla.org/ja/docs/Web/HTML">mdn web docs</a>などを参照してみてください。
- ダウンロードやGit cloneしてきたファイルを、**ディレクトリ構造を保ったまま**Web root直下に置いてください。
- ディレクトリ構造は以下の通りです：

```
.
├── README.md
├── SQL
│   ├── delete
│   │   └── delete.php
│   ├── insert
│   │   ├── insert.html
│   │   └── insert.php
│   └── list
│       └── list.php
├── html
│   ├── checkbox
│   │   ├── checkbox_input.html
│   │   └── checkbox_input.php
│   ├── password
│   │   ├── password_input.html
│   │   └── password_input.php
│   ├── radio
│   │   ├── radio_input.html
│   │   └── radio_input.php
│   ├── select
│   │   ├── select_input.html
│   │   └── select_input.php
│   ├── text
│   │   ├── text_input.html
│   │   └── text_input.php
│   ├── textarea
│   │   ├── textarea_input.html
│   │   └── textarea_input.php
│   └── upload
│       ├── file_input.html
│       ├── file_input.php
│       └── uploads
├── index.html
└── style.css
```
htmlディレクトリにはHTMLからPHPを呼び出して実行するコードが、SQLディレクトリにはMySQLの操作関係のコードが入っています。

フォルダ直下のindex.htmlにあるリンクから、各例に飛ぶことができます。


## 全体に共通するポイント

1. **セキュリティ:**
   - **エスケープ処理:**  
     入力値を安全に処理するために、HTMLに表示する際は `htmlspecialchars` を使用します。
   - **ファイルアップロード:**  
     ファイルの保存先を制限し、`basename()` でファイル名を検証します。

2. **フォームデータの送信:**
   - フォームは `POST` メソッドを使用します。`GET` メソッドはデータがURLに表示されるため、個人情報には適していません。

3. **ディレクトリとファイル権限:**
   - ファイルアップロードを扱う場合、`uploads/` ディレクトリには書き込み権限を設定してください。

4. **エラー処理:**
   - ファイルアップロードやデータベース操作では、エラー時の処理を必ず記述します。

## HTMLからPHPを呼び出すには？

###  **フォームタグの基本構造**

HTMLからPHPを呼び出すには、フォーム（`<form>`）タグを使います。以下は基本的なフォームの構造です。

```html
<form action="処理するPHPファイル" method="POSTまたはGET">
    <!-- 入力項目 -->
    <input type="text" name="example">
    <button type="submit">送信</button>
</form>
```

### 属性の説明

1. **`action` 属性**  
   - このフォームが送信された際に処理を行うPHPファイルを指定します。
   - 例: `action="process.php"`  
     → フォームを送信すると `process.php` が実行されます。

2. **`method` 属性**  
   - データの送信方法を指定します。主に2つの選択肢があります:
     - **`POST`**:  
       フォームデータがリクエストボディ内に含まれるため、URLにデータが表示されません。
       - セキュリティが必要なデータ（例: パスワード）の送信に適しています。
     - **`GET`**:  
       フォームデータがURLのクエリパラメータとして送信されます。
       - データが短く、セキュリティの問題がない場合（例: 検索クエリ）に適しています。

## **フォーム送信の流れ**

1. **HTMLフォームを表示する:**  
   - ユーザーがフォームにデータを入力。

2. **フォームを送信する:**  
   - 指定されたPHPファイルにデータが送信される。

3. **PHPがデータを処理する:**  
   - 送信されたデータを受け取り、必要な処理を行う（例: データベースへの保存や画面への出力）。

---

## 5. **サンプルコード**

ここまでの説明を振り返りながら、以下のコードを確認してみましょう。

### **HTMLフォーム**

```html
<form action="process.php" method="post">
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">送信</button>
</form>
```

### **PHPスクリプト**

```php
<?php
// POSTデータを受け取る
$name = $_POST['name'];

// 安全に表示
echo "こんにちは、" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "さん！";
?>
```
---

# HTMLとPHP

## 各スクリプトの説明

以下、このリポジトリにアップロードしているファイルごとの説明です。

### 1. テキスト入力フォーム (`text_input.php`)
- **用途:** 名前や簡単なテキストを入力する基本フォームです。
- **ポイント:**  
  ユーザーから送信された名前を画面に表示します。
  ```php
  echo "こんにちは、" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "さん！";
  ```

---

### 2. パスワード入力フォーム (`password_input.php`)
- **用途:** パスワードや秘密情報を入力するフォーム。
- **ポイント:**  
  パスワードは出力しない設計になっています。必要に応じてハッシュ化（例: `password_hash`）を行います。

---

### 3. ラジオボタン (`radio_input.php`)
- **用途:** ユーザーが選択肢の中から1つだけ選ぶ場合に使用します。
- **ポイント:**  
  ラジオボタンで選択された値を受け取り、出力します。
  ```php
  $gender = $_POST['gender'];
  echo "選択された性別: " . htmlspecialchars($gender, ENT_QUOTES, 'UTF-8');
  ```

---

### 4. チェックボックス (`checkbox_input.php`)
- **用途:** 複数の選択肢から1つ以上を選べる場合に使用します。
- **ポイント:**  
  選択された値は配列として受け取ります。`implode` を使用して出力します。
  ```php
  echo "選択されたフルーツ: " . htmlspecialchars(implode(', ', $fruits), ENT_QUOTES, 'UTF-8');
  ```

---

### 5. セレクトボックス (`select_input.php`)
- **用途:** 複数の選択肢から1つを選ぶ場合に使用します。
- **ポイント:**  
  選択された値を直接受け取り、画面に出力します。
  ```php
  $prefecture = $_POST['prefecture'];
  echo "選択された都道府県: " . htmlspecialchars($prefecture, ENT_QUOTES, 'UTF-8');
  ```

---

### 6. テキストエリア (`textarea_input.php`)
- **用途:** コメントや長文を入力するフォーム。
- **ポイント:**  
  テキストエリアの内容は改行を保持するため、`nl2br` を使用します。
  ```php
  echo "入力されたコメント: " . nl2br(htmlspecialchars($comment, ENT_QUOTES, 'UTF-8'));
  ```

---

### 7. ファイルアップロード (`file_input.php`)
- **用途:** 画像や文書ファイルなどをサーバーにアップロードする場合に使用します。
- **ポイント:**  
  - アップロードされたファイルは一時フォルダから安全なディレクトリに移動します。
  - エラー処理を行い、不正なファイルのアップロードを防ぎます。
  ```php
  move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/" . $uploadedFileName);
  ```
### ファイルアップロードに関する注意点  
アップロード可能なファイル形式やサイズを制限してください。

---

# HTMLを介したSQLの操作

フォームを使用してデータベース操作を行う際には、セキュリティ上のリスクを十分に理解し、適切な対策を講じる必要があります。以下に具体的な注意事項と実行方法を説明します。

## 注意事項

1. **セキュリティ:**  
   以下のポイントを守った安全対策を行うことが重要です。
   - 入力値のバリデーション
   - SQLインジェクション対策（例: PDOの使用）
   - CSRFトークンの実装

2. **デバッグ:**  
   開発中はエラーを画面に表示するよう設定できますが、本番環境ではエラーログを活用してください。

---

## 注意事項の詳細

### 1. **セキュリティ**

#### 1.1 入力値のバリデーション

ユーザーから送信されたデータが期待される形式であるかを検証します。これにより、不正なデータや予期しないデータの受け取りを防ぎます。

例: 数字のみを受け取る場合
```php
$id = $_POST['id'];
if (!is_numeric($id)) {
    die("IDは数値である必要があります。");
}
```

---

#### 1.2 SQLインジェクション対策

ユーザー入力を直接SQLクエリに埋め込むと、攻撃者に不正なSQLコードを実行される可能性があります。この問題を防ぐには、**プリペアドステートメント**を使用します。

例: PDOを使った安全なSQLクエリ
```php
// ユーザー入力を安全にSQLに埋め込む例
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch();
```

これにより、SQLクエリ内の入力値が適切にエスケープされ、インジェクション攻撃を防ぎます。

---

#### 1.3 CSRFトークンの実装

**CSRF（クロスサイトリクエストフォージェリ）攻撃**を防ぐために、フォームに**CSRFトークン**を追加します。トークンはランダムな値で、サーバーで生成してセッションに保存し、フォームの送信時に一致するか確認します。

CSRFトークンの例:
- フォーム側（HTML）
```php
<?php
session_start();
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>
<form action="submit.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">送信</button>
</form>
```

- サーバー側（PHP）
```php
session_start();
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("不正なリクエストです。");
}
```

これにより、他サイトからの不正なリクエストを防ぐことができます。

---

### 2. **デバッグ**

開発中は、エラーを画面に表示して問題の特定を容易にします。ただし、本番環境ではエラーがユーザーに表示されないように設定します。

- **開発環境**: エラーを画面に表示
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

- **本番環境**: エラーをログに記録
```php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log');
```

これにより、本番環境でセキュリティを強化しつつ、問題があった場合にログで確認できます。

---

## 実行方法

1. **ローカルサーバーのセットアップ**  
   Xampp等を使って実行します。

   なお、PHPのビルトインサーバーを使用してローカルで実行することも可能です。以下のコマンドをターミナルで実行してください。
   ```bash
   php -S localhost:8000
   ```

2. **HTMLフォームの確認**  
   ブラウザで `http://localhost/` を開きます。扉ページを整備しているので、動作を確認したい例にすぐアクセスできます。

3. **フォームの送信とPHPスクリプトの実行**  
   フォームにデータを入力して送信すると、バックエンドのPHPスクリプトが実行されます。結果が画面に表示されるか、データベースに反映されます。

---

## 注意点

- **初心者向け推奨:**  
  最初は、サンプルコードをそのまま実行して動作を確認してください。その後、コードをカスタマイズして理解を深めましょう。

- **セキュリティ:**  
  実際のアプリケーションでは、セキュリティ対策を徹底することが重要です。本ドキュメントで紹介した内容をベースに、必要に応じて機能を拡張してください。


このドキュメントを参考に、HTMLフォームとPHPを連携させた基本的な操作を学び、セキュリティを意識したプログラムを書く力を身につけましょう。

---

# HTMLとPHPファイル構成の違いについて

このプロジェクトでは、以下のようにファイル構成が異なっています。

1. **Insertの例:**  
   HTMLフォーム（`insert.html`）とPHP処理（`insert.php`）が**分かれたファイル**になっています。

2. **その他の例:**  
   HTMLフォームとPHP処理が**1つのファイル**に統合されています。

---

## 1. **InsertがHTMLとPHPで分かれている理由**

Insertの例では、HTMLフォームとPHP処理を分けることで、以下のようなメリットがあります。

### メリット

1. **役割を明確に分離できる:**
   - `insert.html` は、ユーザーにデータを入力してもらう「フロントエンド（入力部分）」を担当します。
   - `insert.php` は、データを受け取って処理する「バックエンド（処理部分）」を担当します。
   - こうすることで、**見た目（HTML）** と **動作（PHP）** が明確に分けられ、コードが読みやすくなります。

2. **再利用性が高い:**
   - 1つのHTMLフォーム（例: `insert.html`）を複数の処理スクリプト（例: `insert.php`, `update.php`）で使い回せるようになります。
   - 複雑なアプリケーションになるほど、HTMLとPHPを分けた構造が役立ちます。

3. **初心者向けに処理の流れが分かりやすい:**
   - フォームを送信すると別のファイル（`insert.php`）が呼び出されるため、データの流れを直感的に理解しやすくなります。

### 例: フォーム送信の流れ
1. ユーザーが `insert.html` を開き、データを入力。
2. データが `POST` メソッドで `insert.php` に送信される。
3. `insert.php` がデータを受け取り、データベースに保存する。

---

## 2. **他の例が1つのファイルに統合されている理由**

ラジオボタンやチェックボックスの例では、HTMLフォームとPHP処理が**1つのファイル**に統合されています。

### 理由

1. **簡潔さ:**  
   これらの例では処理がシンプルで、データの入力から出力までが短いコードで記述できます。そのため、HTMLとPHPを分ける必要が少ないです。

2. **リアルタイムなデータ処理:**  
   ラジオボタンやチェックボックスの例では、フォーム送信後にすぐ結果を表示します。このような処理では、HTMLとPHPを1つのファイルにまとめたほうがスムーズです。

---

## 3. **いつHTMLとPHPを分けるべきか？**

以下の場合には、HTMLとPHPを分けることが推奨されます。

1. **複雑なフォームを扱う場合:**
   - 例: 入力フォームが複数ページにまたがる場合や、大量のデータを扱う場合。

2. **バックエンド処理が多い場合:**
   - 例: データの検証、データベース操作、エラーメッセージの表示などが多い場合。

3. **フロントエンドとバックエンドを分離する設計を目指す場合:**
   - 例: 大規模なアプリケーションでは、HTMLとPHPを分けてモジュール化することで、コードの保守性が向上します。

---

## 4. **いつHTMLとPHPを統合するべきか？**

以下の場合には、HTMLとPHPを1つのファイルに統合しても問題ありません。

1. **シンプルな処理の場合:**
   - 例: 入力値をそのまま画面に表示するだけのフォーム。

---

# insert.phpのHTML内コードの解説

## 概要

- データベースから取得したデータを安全にHTMLテーブルとして出力する基本例です。
- 特に `htmlspecialchars` を使うことで、出力内容の安全性を確保しています。
- 初心者の方は、このコードを使ってループ処理やエスケープ処理の仕組みを理解してください。

## **PHPによるデータベース結果のHTMLテーブル出力**

以下のコードは、データベースから取得した情報をHTMLのテーブルとして表示する部分です。このコードのポイントを丁寧に解説します。

```php
<?php foreach ($users as $user): ?>
<tr>
    <td><?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
</tr>
<?php endforeach; ?>
```

**delete.php**の中にも同様のコードがありますが、そちらもやっていることは同じです。
データベースから情報を取得してHTMLに表示する場合、その時点で登録されているデータすべてを参照する必要があるため、**`foreach`ループ**が使われることが多いのです。

このようなループは、「複数のデータを順番に処理する必要がある場合」に最適です。特に、データベースから複数の行を取得した場合は、それぞれの行にアクセスするために `foreach` を使用します。

データベースから取得する情報は「配列の形」でPHPに渡されます。この配列は複数の行（レコード）を含んでおり、1つずつ取り出すためにループを使います。テーブル表示や削除用選択肢の生成など、「すべてのデータを扱う処理」では、この配列のすべての要素を1回ずつ処理する必要があります。そのため、foreach が自然な選択肢となります。

たとえば`delete.php`では、選択肢を作るために `foreach` を使っていますが、目的は「HTMLの `<option>` タグを動的に生成すること」です。以下にその例を示します。

```php
<?php foreach ($users as $user): ?>
    <option value="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <?php echo htmlspecialchars($user['id'] . ': ' . $user['name'], ENT_QUOTES, 'UTF-8'); ?>
    </option>
<?php endforeach; ?>

```
テーブル表示用のコードでは `<tr> `タグを生成し、削除用のフォームでは `<option>` タグを生成していますが、どちらも `foreach` の使い方としては同じです。HTMLの内容を動的に作成する際に、このループが役立つ点を理解しましょう。

---

# 詳説
以下、コード１行１行の解説を行います。

### 1. **`foreach`ループ**

```php
<?php foreach ($users as $user): ?>
```

- **`foreach`構文の説明:**
  - `$users` は、データベースから取得したすべてのユーザーデータが格納された配列です。
  - このループは、配列 `$users` の各要素を `$user` に一つずつ取り出しながら処理を行います。
  - **例:** `$users` が以下のようなデータの場合:
    ```php
    $users = [
        ['id' => 1, 'name' => '山田太郎', 'email' => 'taro@example.com'],
        ['id' => 2, 'name' => '鈴木花子', 'email' => 'hanako@example.com']
    ];
    ```
    - 1回目のループでは `$user` は `['id' => 1, 'name' => '山田太郎', 'email' => 'taro@example.com']`。
    - 2回目のループでは `$user` は `['id' => 2, 'name' => '鈴木花子', 'email' => 'hanako@example.com']`。

- **`:`と`endforeach`について:**
  - PHPのループ構文には、`foreach ... :` と書き、ループの終わりに `endforeach` を使用する方法があります。この書き方はHTMLとPHPを混在させる場合に便利です。

---

### 2. **HTMLの行作成（`<tr>`タグ）**

```php
<tr>
    <td><?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></td>
    <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
</tr>
```

- この部分は、各ユーザーのデータを1行（`<tr>`タグ）としてHTMLテーブルに表示します。
- `<td>`タグは、テーブルの1つのセルを表します。それぞれ以下の情報が出力されます:
  1. **`$user['id']`**: ユーザーのID。
  2. **`$user['name']`**: ユーザーの名前。
  3. **`$user['email']`**: ユーザーのメールアドレス。

- **`<?php echo ... ?>`の役割:**
  - PHPコードの出力部分です。`echo` を使って値をHTMLとして出力します。

---

### 3. **`htmlspecialchars`関数**

```php
htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8');
```

- **目的:**  
  ユーザー入力をそのまま表示すると、HTMLやJavaScriptのコードが埋め込まれるリスクがあります。これを防ぐため、`htmlspecialchars` 関数を使って出力内容をエスケープします。

- **引数の意味:**
  1. **第1引数:** `$user['id']` など、エスケープしたい文字列。
  2. **第2引数:** `ENT_QUOTES` を指定すると、シングルクォート（`'`）とダブルクォート（`"`）の両方がエスケープされます。
  3. **第3引数:** `UTF-8` は文字コードを指定します。HTMLドキュメントがUTF-8で書かれている場合はこれを使用します。

- **エスケープの効果:**
  - ユーザーが以下のような危険な文字列を送信した場合でも、安全に表示できます。
    - 入力: `<script>alert('危険なコード');</script>`
    - エスケープ後: `&lt;script&gt;alert(&#039;危険なコード&#039;);&lt;/script&gt;`
    - 結果として、ブラウザはコードを実行せず、安全な文字列として表示します。

---

### 4. **ループの終了**

```php
<?php endforeach; ?>
```

- ループを終了します。この部分で `$users` 内のすべてのデータが出力され終わります。

---

## このコードが安全である理由

1. **`htmlspecialchars`によるエスケープ:**
   - ユーザー入力をそのまま表示しないため、クロスサイトスクリプティング（XSS）攻撃を防ぎます。

2. **データベースのクエリでの安全性:**  
   - データベースから取得した内容が不正なスクリプトを含んでいる場合でも、このエスケープ処理により安全に表示できます。

---

## サンプル出力の例

以下のようなデータベースのデータがあるとします:
```php
$users = [
    ['id' => 1, 'name' => '山田太郎', 'email' => 'taro@example.com'],
    ['id' => 2, 'name' => '鈴木花子', 'email' => 'hanako@example.com']
];
```

上記のコードが実行されると、以下のようなHTMLテーブルが生成されます。

```html
<table>
    <tr>
        <td>1</td>
        <td>山田太郎</td>
        <td>taro@example.com</td>
    </tr>
    <tr>
        <td>2</td>
        <td>鈴木花子</td>
        <td>hanako@example.com</td>
    </tr>
</table>
```
