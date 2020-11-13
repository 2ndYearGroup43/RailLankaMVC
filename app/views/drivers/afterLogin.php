<?php
    if(isset($_SESSION['driver_id'])){
        echo "user is logged in";
    }else{
        echo "nada";
    }

?>