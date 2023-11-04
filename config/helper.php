<?php
/*
 * |-------------------------------------------------------
 * | Validate Input
 * |-------------------------------------------------------
 */
function validate_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
}

/*
 * |-------------------------------------------------------
 * | Display error message
 * |-------------------------------------------------------
 */
function display_error($class_name,$message) {
  	echo "<div class='alert $class_name'>$message</div>";
}

/*
 * |-------------------------------------------------------
 * | Fetch single data
 * |-------------------------------------------------------
 */
function fetch_single($table,$field,$key,$value) {
  	$sql = "SELECT $field FROM $table WHERE $key = '$value' LIMIT 1";
	$result = $GLOBALS['conn']->query($sql);
	if ($result->num_rows > 0) {
    	$data = $result->fetch_assoc();
    	return $data;
	}else{
		return FALSE;
	}	
}

/*
 * |-------------------------------------------------------
 * | Fetch multiple data
 * |-------------------------------------------------------
 */
function fetch_multiple($table,$field,$key,$value) {
  	$sql = "SELECT $field FROM $table WHERE $key = '$value'";
	$result = $GLOBALS['conn']->query($sql);
	if ($result->num_rows > 0) {
    	$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	return $data;
	}else{
		return FALSE;
	}	
}

/*
 * |-------------------------------------------------------
 * | Fetch data with custom query
 * |-------------------------------------------------------
 */
function fetch_custom($sql) {
	$result = $GLOBALS['conn']->query($sql);
	if ($result->num_rows > 0) {
    	$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    	return $data;
	}else{
		return FALSE;
	}	
}

/*
 * |-------------------------------------------------------
 * | Insert array of data
 * |-------------------------------------------------------
 */
function insert($table,$data) {
	// retrieve the keys of the array (column titles)
    $fields = array_keys($data);
    // build the query
    $sql = "INSERT INTO ".$table." (`".implode('`,`', $fields)."`) VALUES('".implode("','", $data)."')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

/*
 * |-------------------------------------------------------
 * | Get user id by using email id
 * |-------------------------------------------------------
 */
function get_user_id($email){
	$data = fetch_single('admins','id_admin','usuario',$email);
	if($data){
		return $data;
	}else{
		return FALSE;
	}
}

/*
 * |-------------------------------------------------------
 * | Validate user login
 * |-------------------------------------------------------
 */
function validate_user($email,$password){
	//encript password to md5
	$password = md5($password);
	$sql = "SELECT id_admin, nombre, apellido, cargo, imagen, cg.descripcion FROM admins JOIN cargos cg ON cg.id = admins.cargo WHERE usuario='$email' AND clave='$password' LIMIT 1";
	$data = fetch_custom($sql);
	if($data){
		//fill the result to session variable
		$_SESSION['MEMBER_ID'] = $data[0]['id_admin'];
		$_SESSION['FIRST_NAME'] = $data[0]['nombre'];
		$_SESSION['LAST_NAME'] = $data[0]['apellido'];
		$_SESSION['CARGO'] = $data[0]['cargo'];
		$_SESSION['IMAGEN'] = $data[0]['imagen'];
		$_SESSION['DESC'] = $data[0]['descripcion'];
		return TRUE;
	}else{
		return FALSE;
	}
}

/*
 * |-------------------------------------------------------
 * | User logout
 * |-------------------------------------------------------
 */
function logout_user(){
	unset($_SESSION['MEMBER_ID']);
	unset($_SESSION['FIRST_NAME']);
	unset($_SESSION['LAST_NAME']);
}

?>