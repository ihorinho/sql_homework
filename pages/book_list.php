<?php

require 'models/book.php';

$books = findAllBooks();

if (get('action') == 'delete' && get('id')) {
    $id = get('id');
    $res = removeBookById($id);

    if ($res === false) {
        setFlash('Error');
        redirect('/index.php?page=book_list');
    }

    setFlash('Removed book #' . $id);
    redirect('/index.php?page=book_list');
}

?>

<a href="index.php?page=book_edit" class="btn btn-success">Add book</a>

<table class = "table table-bordered table-hover table-responsive" border="1" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($books as $book) : ?>
        <tr>
            <td><?=$book['id']?></td>
            <td><?=$book['title']?></td>
            <td><?=$book['price']?></td>
            <td>
                <a href="index.php?page=book_edit&amp;id=<?=$book['id']?>">Edit</a>
                <a href="index.php?page=book_list&amp;action=delete&amp;id=<?=$book['id']?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>



</table>

