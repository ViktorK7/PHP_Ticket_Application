<?php 
    include "../base.php";

    if ($_SESSION['userId']) {
        header("Location: ../home/tickets.php");
    }

    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $workPosition = $_POST['workPosition'];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($password == $confirmPassword) {
            $sql = "Insert into users(email, first_name, last_name, password, work_position) Values(:email, :firstName, :lastName, :password, :workPosition)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':workPosition', $workPosition, PDO::PARAM_STR);
            $stmt->execute();
            header("Location: login.php");
        }
    }

?>

<style>
    section {
        width: 100%;
    }
    select {
        text-align: center;
    }
</style>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row  justify-content-center align-items-center h-100">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

            <form class="mb-md-5 mt-md-4 " name="form" method="POST" action="">

                <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                <p class="text-white-50 mb-5">Please enter your credentials!</p>

                <div class="form-outline form-white mb-4">
                    <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required/>
                    <label class="form-label" for="typeEmailX">Email</label>
                </div>

                <div class="form-outline form-white mb-4 row">
                <div class="col-6">
                    <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" required/>
                    <label class="form-label" for="firstName">First Name</label>
                </div>
                <div class="col-6">
                    <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" required/>
                    <label class="form-label" for="lastName">Last Name</label>
                </div>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Password</label>
                </div>

                <div class="form-outline form-white mb-4">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg" required/>
                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                </div>

                <div class="form-outline form-white mb-4">
                <select class="form-control" id="workPosition" name="workPosition" required>
                    <option type="radio" id="" name="work_postion" value="">-- Please Select Work Position --</option>
                    <option type="radio" id="" name="work_postion" value="junior" >Junior Developer</option>
                    <option type="radio" id="" name="work_postion" value="midLevel" >Mid-level Developer</option>
                    <option type="radio" id="" name="work_postion" value="senior" >Senior Developer</option>
                    <option type="radio" id="" name="work_postion" value="officeSupport" >Office Support</option>
                    <option type="radio" id="" name="work_postion" value="technicalSupport" >Technical Support</option>
                </select>
                <label class="form-label" for="workPosition">Work position</label>
                </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit" >Sign Up</button>
            </form>

            <div>
                <p class="mb-0">Do you already have account? <a href="login.php" class="text-white-50 fw-bold">Login</a></p>
            </div>

            </div>
        </div>
    </div>
  </div>
</section>