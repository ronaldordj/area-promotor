<?php
if (!isset($_SESSION['usuarioId'])) {
	session_unset();
	session_destroy();

	header('location:../login');
}
?>
