<?php
     include "../base.php";
     $ticketId = $_GET['ticketId'];
     $database->deleteTicket($ticketId);
     header("Location: tickets.php");
?>