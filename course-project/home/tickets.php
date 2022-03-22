<?php
    include "../base.php";
    // var_dump($_SESSION['userId']); die;
    if (isset($_SESSION['userId']) && $_SESSION['userId'] == null) {
        header("Location: ../login/login.php");
    }

    $workPositon = $database->checkIsSupport($_SESSION['userId']);
    $tickets = $database->getTickets($workPositon);


?>

<div class="container-fluid" style="padding: 10px">
        <div class="title" style="text-align: center">
            <div style="float: right">
                <a href="create.php">
                    <button class="btn btn-success bi-file-earmark-plus-fill"></button>
                </a>
            </div>
            <h3>Contract</h3>
        </div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Author</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Visible</th>
                <th scope="col">Type</th> 
                <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $key=>$ticket): ?>
                    <tr>
                        <th scope="row"><?= $key+1 ?></th>
                        <td><image src="../image/<?= $ticket['image'] ?>" style="width:128px;height:128px"></td>
                        <td><?= $database->getFullName($ticket['userId']) ?></td>
                        <td><?= $ticket['title'] ?></td>
                        <td><?= $ticket['description'] ?></td>
                        <td><?= $ticket['visible'] ?></td>
                        <td><?= $ticket['type'] ?></td>
                        <td>
                            <a href="comments/comments.php?ticketId=<?= $ticket['id'] ?>"
                               class="btn btn-info bi-chat-dots-fill"></a>
                            <a href="edit.php?ticketId=<?= $ticket['id'] ?>" 
                               class="btn btn-warning bi-pencil-fill"></a>
                            <a href="delete.php?ticketId=<?= $ticket['id'] ?>"
                               class="btn btn-danger bi-file-earmark-x-fill"
                               onclick="return confirm('Are you sure!')"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
