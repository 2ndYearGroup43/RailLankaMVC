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