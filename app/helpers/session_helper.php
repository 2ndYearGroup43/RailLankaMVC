<?php   
    session_start();
    function isModeratorLoggedIn()
    {
        if (isset($_SESSION['moderator_id'])) {
            return true;
        }else{
            return false;
        }

    }
//added
    function isLoggedIn() {
		if(isset($_SESSION['userid'])) {
			return true;
		} else {
			return false;
		}
	}

	function isPassenger() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!=1)
			{
				header('location:' . URLROOT . '/users/logout');
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

	function isModerator() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!=3)
			{
				header('location:' . URLROOT . '/users/logout');
			}
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