<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src='js/jquery-3.1.1.min.js'></script>
    <script src='bootstrap/js/bootstrap.min.js'></script>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class='navbar-brand' href="#">
                <?=
                isset($_SESSION['user']) ?
                    $_SESSION['user'] :
                    'Anon.'
                ?>
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/sql.admin/">Home</a></li>
                <!-- <li><a href="index.php?page=comments">Comments</a></li> -->
                <li><a href="index.php?page=book_list">Books</a></li>
                <li>
                    <?php if (isset($_SESSION['user'])) :?>
                        <a href="index.php?page=logout">Logout</a>
                    <?php else: ?>
                        <a href="index.php?page=login">Login</a>
                    <?php endif;?>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container"><br>
    <div class="alert alert-info"><?=getFlash()?></div>
    <?=$content?>

</div><!-- /.container -->

<hr> &copy; <?=date('Y')?>

</body>
</html>