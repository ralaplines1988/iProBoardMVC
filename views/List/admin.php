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

        <?php while($row_RecBoard=$data->RecBoard->fetch_assoc()){?>
        <div class="author-info">
            <img class="avatar" src="/mvc/images/<?= $row_RecBoard["boardimage"]?>" alt="avatar">
            <p class="author-name"><?= $row_RecBoard["boardname"]?><span
                    class="gender"><?=$row_RecBoard["boardsex"]?></span></p>
        </div>
        <div class="message-display-area">
            <p class="contentTitle"><?= $row_RecBoard["boardsubject"]?></p>
            <p><?= $row_RecBoard["boardcontent"]?></p>
        </div>
        <div class="message-info clearfix">
            <p><span class="posted-time" title="date"><?= $row_RecBoard["boardtime"]?></span> |
                <?php if($row_RecBoard["boardmail"]!==''){?><a href="mailto:<?= $row_RecBoard["boardmail"]?>"
                    title="email"><i
                        class="fas fa-envelope"></i></a><?php }?><?php if($row_RecBoard["boardweb"]!==''){?> | <a
                    href="" title="website"><i class="fab fa-staylinked"></i></a><?php }?></p>
        </div>
        <div class="admin message-info clearfix">
            <p><a href="/mvc/list/adminedit/<?php echo $row_RecBoard["boardid"];?>" title="edit"><i
                        class="fas fa-edit"></i></a> | <a href="/mvc/list/admindel/<?php echo $row_RecBoard["boardid"];?>"
                    title="delete"><i class="fas fa-eraser"></i></a></p>
        </div>
        <?php } ?>

        <div class="page-info clearfix">
            <span class="total-num">Total: <?= $data->total_records;?></span>
            <div class="page-nav">
                <?php if ($data->num_pages > 1) {?>
                <a href="/mvc/list/admin/1">FirstPage</a> | <a href="/mvc/list/admin/<?php echo $data->num_pages-1;?>">PrevPage</a>
                <?php }?>
                <?php if ($data->num_pages < $data->total_pages) {?>
                <a href="/mvc/list/admin/<?php echo $data->num_pages+1;?>">NextPage</a> | <a
                    href="/mvc/list/admin/<?php echo $data->total_pages;?>">LastPage</a>
                <?php }?>
            </div>
        </div>
    </main>
    <?php $this->footer();?>
</body>

</html>