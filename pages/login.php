<?php

require 'models/user.php';
// findUser('admin@adminka.com', 'komarik333');

if(requestIsGet() && isset($_COOKIE['username']) && isset($_COOKIE['password']) ){
    $user['username'] = $username = $_COOKIE['username'];
    $user['password'] = $password = $_COOKIE['password'];
}

if (requestIsPost()) {
   
    if (loginFormIsValid()) {
        $user['username'] = post('username'); // $_POST['username']
        $user['password'] = post('password');

        $user = findUser($user['username'], $user['password']);

        if ($user['email'] !== null && $user['password'] !== null) {
            $_SESSION['user'] = $user['email'];
            $email_parts = explode('@', $user['email']);
            $_SESSION['nickname'] = $email_parts[0];

            //Send cookie if 'Remeber me - is checked'
            if(post('remember') === 'on'){
                //set cookies for a week
                setcookie('username',$user['email'], time() + 3600*24*7);
                setcookie('password', post('password'), time() + 3600*24*7);
            }

            setFlash('Signed in');
            redirect('index.php');
        }

        setFlash('User not found');
        redirect('index.php?page=login');
    }
    setFlash('Fill the fields');
}
?>

<h1>Sign in</h1>
<form class="form-signin" method='post'>
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputEmail" class="sr-only">Email address'</label>
    <input value='<?=isset($username) ? $username : post('username')?>' name='username' type="text" id="inputEmail" class="form-control" placeholder="Email address"  autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name='password' type="password" id="inputPassword" class="form-control" placeholder="Password" value="<?= isset($password) ? $password : null?>">
    <div class="checkbox">
        <label>
            <input type="checkbox" value="on" name='remember'> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>