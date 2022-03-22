<?php
    include "../base.php";
    // var_dump($_SESSION['userId']); die;
    if (isset($_SESSION['userId']) && $_SESSION['userId'] == null) {
        header("Location: ../login/login.php");
    }

    $ticketId = $_GET['ticketId'];
    $ticket = $database->getTicketCredentials($ticketId);
    $title = $ticket['title'];
    $image = $ticket['image'];
    $description = $ticket['description'];
    $visible = $ticket['visible'];
    $type = $ticket['type'];

    // $type = 'officeSupport';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql = '
        Update tickets
        Set title= :title, description = :description, image = :image, visible = :visible, type = :type
        Where id = :id'; 
        
        $title = $_POST['title'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $visible = $_POST['visible'];
        $type = $_POST['type'];

        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $ticketId, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':visible', $visible, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: tickets.php");
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
                    <input type="text" id="title" 
                    name="title" 
                    class="form-control form-control-lg" 
                    value='<?= $title ?>' 
                    required/>
                    <label class="form-label" for="title">Title</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <textarea type="text" id="description" 
                    name="description" 
                    class="form-control form-control-lg" 
                    value='<?= $description ?>'
                    required><?= $description ?></textarea>
                    <label class="form-label" for="description">Description</label>
                </div>

                <div class="form-outline form-white mb-4 row">
                    <div class="col-6">
                        <select class="form-control" id="visible" name="visible" value='<?= $visible ?>' required>
                            <option type="radio" id="" name="visible" value="">-- Please Select Visible --</option>
                            <option type="radio" id="" name="visible" value="me" >Me</option>
                            <option type="radio" id="" name="visible" value="all" >All</option>
                        </select>
                        <label class="form-label" for="visible">Visible</label>
                    </div>
                    <div class="col-6">
                        <select class="form-control" id="type" name="type" value='<?= $type ?>' required>
                            <option type="radio" id="" name="type" value="">-- Please Select Type --</option>
                            <option type="radio" id="" name="type" value="officeSupport" >Office Support</option>
                            <option type="radio" id="" name="type" value="technicalSupport" >Technical Support</option>
                        </select>
                        <label class="form-label" for="type">Type</label>
                    </div>
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