<?php
//Inicia a sessão
session_start();

//Verifica se exite os dados na sessão de login
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {
    //Usuário não logado, redireciona para a página de login
    header("Location: login.html");
    exit();
}


