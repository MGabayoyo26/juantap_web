<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
//*Action to delete Passengers Account
if($action == 'delete_account'){
	$save = $crud->delete_account();
	if($save)
		echo $save;
}

//delete jeep
if($action == 'delete_jeep'){
	$save = $crud->delete_jeep();
	if($save)
		echo $save;
}

//delete driverinfo
if($action == 'delete_driverInfo'){
	$save = $crud->delete_driverInfo();
	if($save)
		echo $save;
}
//save jeep
if($action == 'save_jeep'){
	$save = $crud->save_jeep();
	if($save)
		echo $save;
}

//driver info
if($action == 'save_driverInfo'){
	$save = $crud->save_driverInfo();
	if($save)
		echo $save;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}

// edit jeep info
if($action == 'update_comment'){
	$save = $crud->update_comment();
	if($save)
		echo $save;
}


if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_station"){
	$save = $crud->save_station();
	if($save)
		echo $save;
}
if($action == "delete_station"){
	$delete = $crud->delete_station();
	if($delete)
		echo $delete;
}
if($action == "save_price"){
	$save = $crud->save_price();
	if($save)
		echo $save;
}
if($action == "delete_price"){
	$delete = $crud->delete_price();
	if($delete)
		echo $delete;
}
if($action == "get_price"){
	$get = $crud->get_price();
	if($get){
		echo $get;
	}
}
if($action == "save_ticket"){
	$save = $crud->save_ticket();
	if($save){
		echo $save;
	}
}
if($action == "save_order"){
	$save = $crud->save_order();
	if($save)
		echo $save;
}
if($action == "delete_order"){
	$delete = $crud->delete_order();
	if($delete)
		echo $delete;
}
ob_end_flush();
?>
