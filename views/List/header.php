<header class="header">
    <h1 class="logo"><a href="./"><i class="fas fa-paw logo-icon"></i>iProBroad</a></h1>
    <nav class="nav-bar">
        <ul class="nav-list">
            <?php if($data === false){?>
                <li class="nav-item"><a href="/mvc/list/login">Login</a></li>
            <?php } else {?>
                <li class="nav-item"><a href="/mvc/list/admin/1/logout">Logout</a></li>
            <?php }?>
            <li class="nav-item"><a href="/mvc/list/browse">Browse</a></li>
            <li class="nav-item"><a href="/mvc/list/post">Post</a></li>
        </ul>
    </nav>
</header>