<?php

/**
 * @param $email
 * @param $password
 * @return array|null
 */
function findUser($email, $password)
{
    global $link;
    $salt = 'salt'; // any text

    $password = md5(md5($salt) . $password);
    // prepare sql
    $sql = "
        SELECT email, password FROM user 
        WHERE email = ? 
        AND password = ? 
    ";

    $stmt = mysqli_prepare($link, $sql);

    mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
    mysqli_stmt_execute($stmt); // qeury result

    // field email -> $email, field password -> $password
    mysqli_stmt_bind_result($stmt, $email, $password);

    mysqli_stmt_fetch($stmt);

    return compact('email', 'password');
}
