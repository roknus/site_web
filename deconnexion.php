<?php
session_start();
$_SESSION['login'] = session_unset($login);
echo '<script> alert("Vous êtes déconnecté!");</script>';
header('Location: index.html');
exit();
?>