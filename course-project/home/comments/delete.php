<?php
     include "../../base.php";
     $ticketId = $_GET['ticketId'];
     $commentId = $_GET['commentId'];
     $database->deleteComment($commentId);
     header("Location: comments.php?ticketId=" . $ticketId);
?>