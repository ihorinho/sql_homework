<?php
require 'models/book.php';
if(!isset($_SESSION['user'])){
    setFlash('You haven\'t rights to edit books!');
    redirect('/sql.admin/index.php?page=book_list');
}

$id = get('id');

if ($_POST) {
    $id = post('id');
    $title = clearStr(post('title'));
    $description = clearStr(post('description'));
    $price = clearPrice(post('price'));
    $is_active = checkboxToInt(post('is_active'));

    if(post('id')){
        if($res = editBook($id, $title, $description, $price, $is_active))
            setFlash('Changes done');
        else
            setFlash('Error');
    }
    else{
        if($res = insertBook($title, $description, $price, $is_active))
            setFlash('Book is added');
        else
            setFlash('Book isn\'t added');
    }
    redirect('/sql.admin/index.php?page=book_list');

}

if ($id === null) {
    // we want to insert new
    echo 'new';

    $book = array(
        'id' => null,
        'title' => null,
        'price' => null,
        'description' => null,
        'is_active' => null
    );
} else {
    // edit by id
    echo 'edit #' . $id;

    $book = findBookById($id);
}

?>


<form class="form-edit-book" method="post">
    <input type="hidden" name="id" value="<?=$book['id']?>">
    Title : <input class="form-control" type="text" name="title" value="<?=$book['title']?>"> <br>
    Price : <input class="form-control" type="text" name="price" value="<?=$book['price']?>"> <br>
    Description: <textarea class="form-control" name="description" id="" cols="30" rows="10"><?=$book['description']?></textarea> <br>
    Is active: <input  class="form-control" type="checkbox" name="is_active" <?=$book['is_active'] ? 'checked': '' ?> > <br>
    <button class="btn btn-default">Go</button>

</form>


