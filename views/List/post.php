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
        <form class="message-sender" method="POST" enctype="multipart/form-data" id="formPost"
            onsubmit="return checkForm();">
            <div class="author-info-sender">
                <div class="input-handler">
                    <label for="authorName">Your Name</label>
                    <input type="text" id="authorName" name="authorName">
                </div>
                <div class="input-handler gender">
                    <p>Your Gender</p>
                    <input type="radio" id="gender-male" name="authorGender" checked value="male">
                    <label for="gender-male">Male</label>
                    <input type="radio" id="gender-female" name="authorGender" value="female">
                    <label for="gender-female">Female</label>
                </div>
                <div class="input-handler">
                    <label for="authorAvatar">Avatar</label>
                    <input type="file" id="authorAvatar" name="authorAvatar" accept="image/*">
                </div>
                <div class="input-handler">
                    <label for="messageTitle">Message Title</label>
                    <input type="text" id="messageTitle" name="messageTitle">
                </div>
                <div class="input-handler">
                    <label for="authorMail">Your Email</label>
                    <input type="text" id="authorMail" name="authorMail">
                </div>
                <div class="input-handler">
                    <label for="authorSite">Your site</label>
                    <input type="text" id="authorSite" name="authorSite">
                </div>
            </div>
            <div class="message-content-sender">
                <textarea class="messageContent" name="messageContent" id="messageContent"
                    placeholder="Enter your content here"></textarea>
            </div>
            <div class="sender-buttons">
                <input type="hidden" name="action" value="add">
                <input type="submit" value="send">
                <input type="reset" value="reset">
                <input type="button" value="back">
            </div>
        </form>
    </main>
    <?php $this->footer();?>
</body>

</html>