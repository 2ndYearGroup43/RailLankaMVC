<?php 
	session_start();

	function isLoggedIn() {
		if(isset($_SESSION['userid'])) {
			return true;
		} else {
			return false;
		}
	}

	//redirect to login if a user is not logged in 
	//if the user is logged in but not as a passenger redirect to the respective dashboard
	function isPassengerLoggedIn(){
		if(isset($_SESSION['userid'])) {
			if($_SESSION['role']!=1){
				redirect($_SESSION['role']);
			}
		} else {
			header('location:' . URLROOT . '/users/login');
		}
	}

	//redirect to the relevant dashboard if the logged in user is not a passenger
	function isPassenger() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!=1)
			{
				redirect($_SESSION['role']);
			}
		}
	}

	function isAdmin() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!=2)
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	//redirect to login if a user is not logged in 
	//if the user is logged in but not as a passenger redirect to the respective dashboard
	function isModeratorLoggedIn() {
		if(isset($_SESSION['userid']))
		{
			if($_SESSION['role']!=3)
			{
				redirect($_SESSION['role']);
			}
		} else {
			header('location:' . URLROOT . '/users/login');
		}
	}

	function isDriver() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!=4)
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	function isResofficer() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!=5)
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	function redirect($role) {

		if($role==1)
		{
			// $_SESSION['role'] = "passenger";
			header('location:' . URLROOT . '/pages/index');
		}

		if($role==2)
		{
			// $_SESSION['role'] = "admin";
			header('location:' . URLROOT . '/admins/index');
		}

		if($role==3)
		{
			// $_SESSION['role'] = "moderator";
			header('location:' . URLROOT . '/moderators/index');
		}

		if($role==4)
		{
			// $_SESSION['role'] = "driver";
			header('location:' . URLROOT . '/drivers/index');
		}

		if($role==5)
		{
			// $_SESSION['role'] = "resofficer";
			header('location:' . URLROOT . '/resofficers/index');
		}
	}