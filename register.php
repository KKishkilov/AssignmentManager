<?php
session_start();
require_once "vendor/autoload.php";
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    if(empty(Validation::validate($_POST))){
        Login::register($username,$password);
         header('Location: login.php');
             die; 
     }else{
       
     }
   


}
?>
<?php require_once 'views/header.php'; ?>
<?php if(!isset($_SESSION['has_logged_in'])): ?>

    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Register</h3>
                <?php if(Validation::getErrors()): ?>
                    <?php foreach(Validation::getErrors() as $error): ?>
                        <h5><?php echo $error; ?></h5>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <form method="post" action="register.php">
                            <div class="form-group">
                                <label for="task_name">Username</label>
                                <input type="text" name="username"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="task_name">Password</label>
                                <input type="password" name="password"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                            </div>

                            <input type="submit" class="btn btn-primary" name="register" value="Register">
                            <!--                            <a href="register.php" class="btn btn-success">Register</a>-->
                            <!---->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else:
    header('Location: index.php');
    ?>
<?php endif; ?>
<?php require_once 'views/footer.php'; ?>