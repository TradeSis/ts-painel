<?php
//Lucas 10/04/2023 modificado a header para ser redirecionado para painel.php
//gabriel 220323 11:19 adicionado idcliente
// helio 26012023 16:16

session_start();


include_once 'conexao.php';
$usuario = $_POST['usuario'];
$passwordDigitada = $_POST['password'];

$dados = array();
$apiEntrada = array(
        'usuario' => $usuario,
);
$dados = chamaAPI(null, '/api/services/usuario/verifica', json_encode($apiEntrada), 'GET');

$password = $dados['password'];
$statusUsuario = $dados['statusUsuario'];
$user = $dados['nomeUsuario'];
$idUsuario = $dados['idUsuario'];
$idCliente = $dados['idCliente'];

$senhaVerificada = md5($passwordDigitada);

//
if (!$user == "") {


        if ($password == $senhaVerificada) {

                $_SESSION['START'] = time(); 
                $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
                $_SESSION['usuario'] = $user;
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['idCliente'] = $idCliente;
                header('Location: /ts/painel/');
                /* header('Location: index.php'); */
        }
        else {
                $mensagem = "senha errada!";
                header('Location: /ts/painel/login.php?mensagem='. $mensagem);
        }
} else {
        $mensagem = "usuario não cadastrado!";
        //$mensagem = $dados['retorno'];
        /* echo $mensagem; */
        header('Location: /ts/painel/login.php?mensagem='. $mensagem);

}