<?php
    include "../../base.php";
    if (isset($_SESSION['userId']) && $_SESSION['userId'] == null) {
        header("Location: ../../login/login.php");
    }
    $ticketId = $_GET['ticketId'];
    $comments = $database->getComments($ticketId);


?>

<div class="container" style="padding: 10px">
    <div class="title" style="text-align: center">
        <div style="float: right">
            <a href="create.php?ticketId=<?= $ticketId ?>">
                <button class="btn btn-success bi-file-earmark-plus-fill"></button>
            </a>
        </div>
        <h3>Comments</h3>
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Message</th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $key=>$comment): ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><image src="../../image/<?= $comment['image'] ?>" style="width:128px;height:128px"></td>
                    <td><?= $comment['message'] ?></td>
                    <td>
                        <a href="edit.php?ticketId=<?= $ticketId ?>&commentId=<?= $comment['id'] ?>"
                            class="btn btn-warning bi-pencil-fill"></a>
                        <a href="delete.php?ticketId=<?= $ticketId ?>&commentId=<?= $comment['id'] ?>"
                            class="btn btn-danger bi-file-earmark-x-fill"
                            onclick="return confirm('Are you sure!')"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
