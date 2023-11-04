<?php
require("config/session.php");
require("config/database.php");
require("config/helper.php");

$email = validate_input(isset($_POST['email'])?$_POST['email']:'');
$password = validate_input(isset($_POST['password'])?$_POST['password']:'');

if($_SERVER['REQUEST_METHOD']==='POST' && is_array($_POST) && !empty($email) && !empty($password)){
    //get user id
    $user_id = get_user_id($email);
    //check user is valid or not
    $status = validate_user($email,$password);
	if($status){
		header( "Location: home.php" ); die;		
	}else{
        if($user_id){
            $data = array(
                'id_admin' => $user_id['id_admin'],
                'tiempo' => time()
                );
            //insert login attempts into table
            insert('intento_login',$data);
        }
		header( "Location: index.php?error=bG9naW4gZXJyb3I=" ); die;
	}
}else{
	header( "Location: index.php" ); die;
}
?>