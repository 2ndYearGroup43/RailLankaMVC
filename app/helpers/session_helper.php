<?php 
	session_start();

	function isLoggedIn() {
		if(isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}

	function isAdmin() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!='admin')
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	function isModerator() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!='moderator')
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	function isPassenger() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!='passenger')
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	function isDriver() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!='driver')
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}

	function isResofficer() {
		if(isset($_SESSION['role']))
		{
			if($_SESSION['role']!='resofficer')
			{
				header('location:' . URLROOT . '/users/logout');
			}
		}
	}