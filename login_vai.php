<?php

//Conexão com DB
require 'comum.php';

//Inicia Sessão
session_start();

$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;

$senha = isset($POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

if (!$login || !$senha) {
    echo "Digite seu login e senha!";
    exit();
}

$SQL = "SELECT id, nome, login, senha, postar "
        . "FROM aut_usuarios "
        . "WHERE login = " . $login . "";

$result_id = mysql_query($SQL) or die("Erro no Banco de Dados");
$total = mysql_num_rows($result_id);

if ($total) {
    // Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão
    $dados = mysql_fetch_array($result_id);

    if (!strcmp($senha, $dados["senha"])) {
        $_SESSION["id_usuario"] = $dados["id"];
        $_SESSION["nome_usuario"] = stripslashes($dados["nome"]);
        $_SESSION["permissao"] = $dados["postar"];
        header("Location: index.php");
        exit();
    } else {
        echo "Senha Inválida Comédia!!";
        exit();
    }
} else{
    echo "Login não existe!";
    exit();
}