<h1>Home page</h1>	
<h3>Hello, <?=isset($_SESSION['nickname']) ?
                    $_SESSION['nickname'] :
                    'guest!'?></h3>	