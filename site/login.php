<?php
session_start();
include('conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha']))
{
	header('Location: index.php');
	exit();
}

$user = $_POST['usuario'];
$password = $_POST['senha'];

//bloco da consulta SQL
$query = "select * from system.STUDENT u
where STD_ID = '{$user}'
and STD_PASS = '{$password}'";
$stid = oci_parse($Oracle, $query) or die ("erro");

OCIDefineByName($stid,"STD_ID",$STD_ID);
OCIDefineByName($stid,"STD_NAME",$STD_NAME);

OCIExecute($stid);

//Abaixo conta a quantidade de linhas retornada da consulta.
echo $nrows = oci_fetch_all($stid, $results);


oci_free_statement($stid);

if($nrows == "1")
{
	session_start();
	$_SESSION['usuario'] = $STD_ID;
	$_SESSION['std_name'] = $STD_NAME;
	$_SESSION['cl'] = "l";
	header('Location:index.php?log=S');
	exit();
}
else
{
	echo  "<script>alert('Senha Inválida!');
			document.location = 'index.php'</script>";
}

//fecha a conexão atual
oci_close($Oracle);

echo $query;exit;

