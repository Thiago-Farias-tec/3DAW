<?php
require "conexao.php";

$id = $_GET["id"];

$sql = "SELECT id, nome, preco FROM acomodacoes WHERE id = $id";
$result = $con->query($sql);

echo json_encode($result->fetch_assoc());
