<?php

require_once 'vendor/autoload.php';
require_once 'views/header.php';
 
if (Input::exists()) {
 
	if (Token::checkToken(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 3,
				'max' => 20
			),
			'password' => array(
				'required' => true,
				'min' => 6,
			),
			'retype_password' => array(
				'required' => true,
				'match' => 'password',
			),
		));

		if ($validation->passed()) {
			$user = new User();
			try {
				$user->create(array(
					'user_name' => Input::get('username'),
					'password' => Hash::make(Input::get('password')),
				));
				Session::flash('home', 'Account successfully created');
				Redirect::to('index.php');
			} catch (Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach ($validation->errors() as $error) {
				echo $error . '<br>';
			}
		}
	}
}
?>

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Register</h3>
                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <form method="post" action="register.php">
                            <div class="form-group">
                                <label for="task_name">Create New User</label>
                                <input type="text" name="username"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="task_name">Password</label>
                                <input type="password" name="password"  class="form-control" value="" id="task_name" aria-describedby="emailHelp">
                            </div>
                        <!--     <a href="register.php" class="btn btn-success">Register</a> -->
                            <input type="submit" value="Register" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>