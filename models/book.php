<?php

function findAllBooks()
{
    global $link;

    $sql = "SELECT * FROM book";
    $res = mysqli_query($link, $sql);

    $books = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $books[] = $row;
    }

    return $books;
}

/**
 * @param $id
 * @return array|null
 */
function findBookById($id)
{
    global $link;
    $id = (int)$id;

    $sql = "SELECT * FROM book WHERE id = {$id}";
    $res = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($res);
}

/**
 * @param $id
 * @return bool|mysqli_result
 */
function removeBookById($id)
{
    global $link;
    $id = (int)$id;

    $sql = "DELETE FROM book WHERE id = {$id}";
    $res = mysqli_query($link, $sql);

    return $res;
}

function insertBook($title, $description, $price, $is_active)
{
    global $link;
    
    $sql = "INSERT INTO book(title, description, price, is_active) 
                VALUES('$title', '$description', '$price', '$is_active')";

    $res = mysqli_query($link, $sql) or die(mysqli_error($link));
    return $res;
}

function editBook($id, $title, $description, $price, $is_active)
{
    global $link;
    
    $sql = "UPDATE book
            SET title = '$title', description = '$description', price = $price, is_active = '$is_active'
            WHERE id = '$id'";

    try{
        $res = mysqli_query($link, $sql);
        if(mysqli_error($link)){
            throw new Exception(mysqli_error($link));
        }
    }
    catch(Exception $e){
    echo $e -> getMessage();
}
    return $res;
}

