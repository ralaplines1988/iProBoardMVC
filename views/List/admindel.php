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
        <form class="message-sender for-delete" action="" method="POST" enctype="multipart/form-data">
            <div class="author-info-sender">
                <div class="input-handler">
                    <label for="authorName">Your Name</label>
                    <span class="info-shower"><?php echo $data->boardname;?></span>
                </div>
                <div class="input-handler gender for-show">
                    <span>Your Gender</span>
                    <span class="info-shower"><?php echo $data->boardsex;?></span>
                </div>
                <div class="input-handler">
                    <label for="messageTitle">Message Title</label>
                    <span class="info-shower"><?php echo $data->boardsubject;?></span>
                </div>
                <div class="input-handler">
                    <label for="authorMail">Your Email</label>
                    <span class="info-shower"><?php echo $data->boardmail;?></span>
                </div>
                <div class="input-handler">
                    <label for="authorSite">Your site</label>
                    <span class="info-shower"><?php echo $data->boardweb;?></span>
                </div>
            </div>
            <div class="message-content-sender">
                <textarea class="messageContent" name="messageContent" id="messageContent"
                    placeholder="Enter your content here" disabled><?php echo $data->boardcontent;?></textarea>
            </div>
            <div class="sender-buttons">
                <input name="authorId" type="hidden" id="authorId" value="<?php echo $data->boardid;?>">
                <input type="hidden" name="action" value="delete">
                <input type="submit" value="delete">
                <input type="button" value="back">
            </div>
        </form>
    </main>
    <?php $this->footer();?>
</body>

</html>