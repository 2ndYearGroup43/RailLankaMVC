<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION['officerId'])) {
            return true;
        } else {
            return false;
        }
    }
