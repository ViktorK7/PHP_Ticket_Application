<?php
    include "../../base.php";
    // var_dump($_SESSION['userId']); die;
    if (isset($_SESSION['userId']) && $_SESSION['userId'] == null) {
        header("Location: ../login/login.php");
    }

    $ticketId = $_GET['ticketId'];
    $commentId = $_GET['commentId'];
    $comment = $database->getCommentCredentials($commentId);
    $message = $comment['message'];
    $image = $comment['image'];

    // $type = 'officeSupport';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = '
        Update comments
        Set message= :message, image = :image
        Where id = :id'; 
        
        $message = $_POST['message'];
        $image = $_POST['image'];

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $commentId, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: comments.php?ticketId=" . $ticketId);
    }

?>
<style>
    select {
        text-align: center;
    }
</style>
<section class="gradient-custom">
  <div class="container py-5 h-100">
    <div class="row  justify-content-center align-items-center h-100">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

            <form class="mb-md-5 mt-md-4 " name="form" method="POST" action="">

                <h2 class="fw-bold mb-2 text-uppercase">Ticket</h2>
                <p class="text-white-50 mb-5">Please enter ticket credentials!</p>

                <div class="form-outline form-white mb-4">
                    <input type="text" id="message" 
                    name="message" 
                    class="form-control form-control-lg" 
                    value='<?= $message ?>' 
                    required/>
                    <label class="form-label" for="title">Message</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="file" id="image" 
                    name="image" 
                    class="form-control form-control-lg" 
                    value='<?= $image ?>'
                    />
                    <label class="form-label" for="image">Image</label>
                </div>
                
                <button class="btn btn-outline-light btn-lg px-5" type="submit" >Submit</button>
            </form>
            </div>
        </div>
    </div>
  </div>
</section>