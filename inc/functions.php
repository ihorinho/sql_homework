<?php
//Functions for sql queries
function clearPrice($data){
    return abs(round((float)$data,2));
}
function clearStr($data){
    return trim(strip_tags($data));
}
function checkboxToInt($data, $int = 1){
    if($data === null){
        return 0;
    }else{
        return $int;
    }
}
//-----------------------------------
function dd($a)
{
    echo '<pre>';
    print_r($a);
    echo '</pre>';
}
function post($key, $default = null)
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
function get($key, $default = null)
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}
function requestIsGet()
{
    return strtolower($_SERVER['REQUEST_METHOD']) == 'get';
}
function requestIsPost()
{
    return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
}
function loginFormIsValid()
{
    return 	post('username') != '' &&
    post('password') !='';
}
function commentsFormIsValid()
{
    return 	post('username') != '' &&
    post('email') !='' &&
    post('message') != '' &&
    post('captcha') == $_SESSION['security_number'];
}
function redirect($to)
{
    header('Location: ' . $to);
    die;
}
function loadComments($file = COMMENTS_DB)
{
    $commentsRaw = file($file);
    $comments = [];
    foreach ($commentsRaw as $comment) {
        $comments[] = unserialize($comment);
    }

    return $comments;
}
function ifPublish()
{
    return (int)(post('publish') !== null);
}
function moderate(array &$comments)
{
    // todo: use array_walk() instead of foreach
    // todo: as -> **, beach -> b***h
    $badWords = ['as', 'beach', 'smuck'];
    foreach ($comments as &$comment) {
        $comment['message'] = str_replace($badWords, '***', $comment['message']);
    }
}
function loadCSV($filename)
{
    $file = file($filename);

    // todo: get rid of this loop
    foreach ($file as &$line) {
        $line = trim($line);
    }
    $keys = explode(',', $file[0]);
    array_shift($file);

    foreach ($file as &$user) {
        $user = explode(',', $user);
        $user = array_combine($keys, $user);
    }
    return $file;
}
function setFlash($message)
{
    $_SESSION['flash_message'] = $message;
}
function getFlash()
{
    if (!isset($_SESSION['flash_message'])) {
        return null;
    }
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
    return $message;
}