<?php

use mysqli_result;

require 'verifica.php';
require 'comum.php';

echo "Bem Vindo " . $_SESSION["nome_usuario"] . "<br>";

$SQL = "SELECT id FROM aut_noticias "
        . "WHERE autor_id = " . $_SESSION["id_usuario"] . "";

$resultado00 = mysql_query($SQL) or die(mysql_error());

$total = mysqli_result::$num_rows($resultado00);

if ($total) {
    echo "Há um total de " . $total . " notícias em sua autoria!\n";
} else {
    echo "Não há nenhuma notícia em sua autoria!\n";
}

if ($_SESSION["permissão"] == "S") {
    echo " | <a href=\"nova.php\">Postar nova notícia</a>\n";
}

echo " | <a href=\"sair.php\">Sair do Sistema</a>";

echo "<br><br>\n";

$SQL = "SELECT id, titulo, data"
        . "FROM aut_noticias"
        . "ORDER BY data DESC";

$resultado01 = mysql_query($SQL) or die(mysql_error());
$total01 = mysqli_result::$num_rows($resultado01);

if($total){
    echo "<table border=1 cellpadding=3 cellspacing=0>\n";
    echo "<tr><th>Id</th><th>Titulo</th><th>Data</th></tr>";
    
    while($dados = mysql_fetch_array($resultado01)){
        echo "<tr><td>".$dados["id"]."</td><td>";
        echo "<a href=\"ver_noticia.php?id=".$dados["id"]."\">".stripcslashes($dados["titulo"])."";
        echo "</a></td>";
        echo "<td>".date("d/m/Y à\s H:i:s",$dados["data"])."</td></tr>\n";
    }
    echo "</table>\n";
    
} else{
    echo "<B>Nenhuma notícia cadastrada!</B>\n";
}





