<?php 

class Validation 
{
	//check username if exists
	//password must be at leasts , 1 uppercase, 1 lowercase 

	public static $fields = ['username','password'];
	public static $errors = [];
	public static function validate($post)
	{
		foreach ($post as $key => $value) {
 
			if(in_array($key, self::$fields)){
			 
				switch ($key) {
					case 'username':
							 if(empty($value)){
							self::$errors[] = 'Please input '. $key;
							
						}
						break;
					case 'password':
							if(strlen($value) < 6){
								self::$errors[] = 'Password should be at least 6 characters';
							}
							if(!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*/',$value)){
								self::$errors[] = 'You have to provide at least 1 uppercase, 1 lowercase and at least one number';
							}
							if(empty($value)){
							self::$errors[] = 'Please input '. $key;
							
						}
						break;
					default:

						// code...
						break;
				}
			}
			
		}
		return self::$errors;
	}

	public static function getErrors(){
		return (isset(self::$errors) && self::$errors != null) ? self::$errors : null;
	}
}