<?php
session_start();
include('conexao.php');

if(empty($_POST['email']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}



$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

$query = "select email from banca_aposta where email = '{$email}' and senha = md5('{$senha}')";
$result = mysqli_query($conn, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['email'] = $email;
	header('Location: novo/index.php');
	exit();
}  
//verifica gerente
     elseif($_POST['email'] || $_POST['senha']){

	$emailc = mysqli_real_escape_string($conn, $_POST['email']);
    $senhac = mysqli_real_escape_string($conn, $_POST['senha']);

       $queryc = "select email from  banca_pv where email = '{$emailc}' and senha = md5('{$senhac}')";
       $resultc = mysqli_query($conn, $queryc);

       $row = mysqli_num_rows($resultc);

        if($row == 1) {
	         $_SESSION['email'] = $emailc;
	        header('Location: gerentes/index.php');
	        exit();
       } 


	   elseif($_POST['email'] || $_POST['senha']){

		$emailcam = mysqli_real_escape_string($conn, $_POST['email']);
        $senhacam = mysqli_real_escape_string($conn, $_POST['senha']);

        $queryca = "select email from  cambista where email = '{$emailcam}' and senha = md5('{$senhacam}')";//tbl ca,bista
        $resultca = mysqli_query($conn, $queryca);

       $row = mysqli_num_rows($resultca);

        if($row == 1) {
	         $_SESSION['email'] = $emailcam;
	        header('Location: cambista/index.php');
	        exit();
} 


else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
} 

	 }


//valida cambista
	else {
	
	
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
} 

	 }




// verifica cidadao




