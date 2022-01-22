<?php
session_start();
include_once '../errorHandler/errorHandlers.php';
set_error_handler('customError',E_ALL);
session_destroy();
header("Location:../home/home.php");
?>