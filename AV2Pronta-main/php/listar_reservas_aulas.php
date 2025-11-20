<?php
require "conexao.php";


$sql = "SELECT r.*, a.nome AS nome_aula FROM reservas_aulas r JOIN aulas a ON a.id = r.id_aula ORDER BY r.id DESC
";

$res = $con->query($sql);
$dados = [];

while ($row = $res->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
