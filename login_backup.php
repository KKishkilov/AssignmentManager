<?php
session_start();
require_once "vendor/autoload.php";

if((isset($_SESSION['has_logged_in']) && $_SESSION['has_logged_in'] == true)){
    header('Location: index.php');
    die;
}
if(isset($_POST['password']) && $_POST['password'] != null && isset($_POST['username']) && $_POST['username'] != null){

    $loggin = new Login();
    if($loggin->getUser($_POST['username'],$_POST['password']) ){

        $_SESSION['username'] = $_POST['username'];
        $_SESSION['has_logged_in'] = true;
        $_SESSION['can_view_content'] = true;
        header('Location: index.php');
    }else{
        if(isset($_SESSION['username']) && isset($_SESSION['has_logged_in'])){
            unset($_SESSION['username']);
            unset($_SESSION['has_logged_in']);
        }

    }

}
?>
<?php require_once 'views/header.php'; ?>
   <?php if(!isset($_SESSION['has_logged_in'])): ?>

    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Login</h3>
                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label for="task_name">Username</label>
                                <input type="text" name="username"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="task_name">Password</label>
                                <input type="password" name="password"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                            </div>

                            <input type="submit" class="btn btn-primary" name="login" value="Login">
                            <a href="register.php" class="btn btn-success">Register</a>
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