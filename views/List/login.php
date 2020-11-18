<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/mvc/css/reset.css">
    <link href="/mvc/css/main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d14ba3f31b.js" crossorigin="anonymous"></script>
    <script src="/mvc/js/main.js" defer></script>
    <title>MVC</title>
</head>

<body>
    <?php $this->header();?>
    <main class="main">
        <h2 class="login-title">LOGIN</h2>
        <span class="tip-info"><?= $data;?></span>
        <form action="" method="POST">
            <div class="user-info-sender">
                <label for="userName">UserName</label><br>
                <input type="text" id="userName" name="userName">
                <label for="userPwd">Password</label><br>
                <input type="password" id="userPwd" name="userPwd">
            </div>
            <div class="sender-buttons">
                <input type="submit" value="send">
                <input type="button" value="back">
            </div>
        </form>
    </main>
    <?php $this->footer();?>
</body>

</html>