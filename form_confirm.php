<?php
session_start();

// CSRFトークンのチェック
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['token'], $_POST['token'])) {
    die('CSRFトークンが無効です。');
}

$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$ruby = htmlspecialchars($_POST['ruby'], ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

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
        <h2 class="center">確認画面</h2>
        <p class="center">以下の内容で送信します。よろしいですか？</p>
        <div class="confirm-text">
            <form action="form_complete.php" method="post">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="ruby" value="<?php echo $ruby; ?>">
                <input type="hidden" name="address" value="<?php echo $address; ?>">
                <input type="hidden" name="tel" value="<?php echo $tel; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="message" value="<?php echo $message; ?>">
                
                <!-- 再度CSRFトークンを送信 -->
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

                <p>お名前: <?php echo $name; ?></p>
                <p>フリガナ: <?php echo $ruby; ?></p>
                <p>ご住所: <?php echo $address; ?></p>
                <p>電話番号: <?php echo $tel; ?></p>
                <p>メールアドレス: <?php echo $email; ?></p>
                <p>メッセージ: <?php echo nl2br($message); ?></p>

                <button type="submit">送信</button>
                <a type="button" onclick="history.back();">トップへ戻る</a>
            </form>
        </div>
    </section>
    
    <!-- フッタ始め -->
    <?php include "inc/footer.php"; ?>
	<!--  フッタ終わり	-->

</body>
</html>
