<?php
session_start();

// CSRFトークンのチェック
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['token'], $_POST['token'])) {
    die('CSRFトークンが無効です。');
}

// ここでデータベースへの保存やメール送信などの処理を行う
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$ruby = htmlspecialchars($_POST['ruby'], ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

// メールヘッダーインジェクション対策
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('有効なメールアドレスを入力してください。');
}

// メール送信
$to = "p-kawa@energy.ocn.ne.jp,info@skc.co.jp";
$subject = "お問い合わせ: $name";
$body = "名前: $name\nフリガナ: $ruby\n住所: $address\n電話番号: $tel\nメールアドレス: $email\n\nメッセージ:\n$message";
$headers = "From: $email";
mail($to, $subject, $body, $headers);

// セッションのトークンをリセット
unset($_SESSION['token']);


$title = 'お問い合わせ｜有限会社 エスケー・コーポレーション';
include 'inc/head.php';
?>
<!-- ページごとのスタイルシートなどはここに追加 -->
</head>
<body>
	<!-- ヘッダ始め -->
    <?php include 'inc/header.php'; ?>
	<!--  ヘッダ終わり	-->

    <section class="confirm clearfix" id="confirm">
       <div class="confirm-text">
            <h2 class="center">送信が完了しました</h2>
            <p class="center">
                お問い合わせありがとうございました。<br>
                内容を確認の上、<br>
                担当者よりご連絡させていただきます。<br>
                少々お時間をいただくこともございますので<br>
                あらかじめご了承ください。
            </p>
            <a type="button" onclick="history.go(-2);">トップへ戻る</a>
       </div>
    </section>

    <!-- フッタ始め -->
    <?php include "inc/footer.php"; ?>
	<!--  フッタ終わり	-->

</body>
</html>
