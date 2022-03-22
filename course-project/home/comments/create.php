<?php
    include "../../base.php";
    // var_dump($_SESSION['userId']); die;
    if (isset($_SESSION['userId']) && $_SESSION['userId'] == null) {
        header("Location: ../login/login.php");
    }
    if($_GET['ticketId']) {
        $ticketId = $_GET['ticketId'];
    } else {
        $ticketId = $_POST['ticketId'];
    }
    // $ticketId = $_GET['ticketId'];
    $message = $_POST['message'];
    $image = $_POST['image'];

    // $type = 'officeSupport';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = "Insert into comments(ticketId, message, image) Values(:ticketId, :message, :image)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':ticketId', $ticketId, PDO::PARAM_STR);
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

                <h2 class="fw-bold mb-2 text-uppercase">Comment</h2>
                <p class="text-white-50 mb-5">Please enter your comment!</p>

                <div class="form-outline form-white mb-4">
                    <textarea type="text" id="message" 
                    name="message" 
                    class="form-control form-control-lg" 
                    value='<?= $message ?>'
                    required></textarea>
                    <label class="form-label" for="message">message</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="file" id="image" 
                    name="image" 
                    class="form-control form-control-lg" 
                    value='<?= $image ?>'
                    />
                    <label class="form-label" for="image">Image</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="text" id="ticketId" 
                    name="ticketId" 
                    class="form-control form-control-lg" 
                    value='<?= $ticketId ?>'
                    hidden
                    />
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit" >Submit</button>
            </form>
            </div>
        </div>
    </div>
  </div>
</section>