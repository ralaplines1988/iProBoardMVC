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
    <div class="welcome-box">
        <p class="wel-info-container">
            <i class="fas fa-paw logo-icon"></i>Welcome!<?php echo $data; ?><i class="fas fa-paw logo-icon"></i>
        </p>
        <br/>
        <a class="enter" href="/mvc/list/browse">Enter</a>
    </div>
</body>
</html>