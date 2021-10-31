<?php
if(!$_SESSION['usuario'])
{
	header('Location: menu.html');
	exit();
}