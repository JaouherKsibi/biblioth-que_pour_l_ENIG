<?php 
session_start();
session_destroy();
header("Location:formulaire_de_connection.html");
?>