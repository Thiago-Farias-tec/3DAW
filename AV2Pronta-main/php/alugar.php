<?php
require "conexao.php";

$id = $_GET['id'];

// Busca acomodação
$sql = "SELECT * FROM acomodacoes WHERE id = $id";
$result = $con->query($sql);
$acomodacao = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Alugar - <?php echo $acomodacao['nome']; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Alugar: <?php echo $acomodacao['nome']; ?></h2>

    <form action="processa_aluguel.php" method="POST" class="card p-4">

        <input type="hidden" name="id_acomodacao" value="<?php echo $acomodacao['id']; ?>">
        <input type="hidden" id="preco" value="<?php echo number_format($acomodacao['preco'], 2, '.', ''); ?>">


        <h4>Seus Dados</h4>

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Telefone</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>

        <hr>

        <h4>Datas</h4>

        <div class="mb-3">
            <label>Entrada</label>
            <input type="date" name="data_inicio" id="inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Saída</label>
            <input type="date" name="data_fim" id="fim" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Valor total</label>
            <input type="text" id="valor" name="valor_total" class="form-control" readonly>
        </div>

        <hr>

        <h4>Método de Pagamento</h4>

        <div class="mb-3">
            <select id="metodo_pagamento" name="metodo_pagamento" class="form-control" required>
                <option value="">Selecione...</option>
                <option value="pix">PIX</option>
                <option value="cartao">Cartão de Crédito</option>
            </select>
        </div>

        <!-- PIX -->
        <div id="area_pix" class="p-3 border rounded d-none">
            <p class="fw-bold text-success">Chave PIX: aluguel@empresa.com</p>
            <img src="../img/qrcode_exemplo.png" width="180">
        </div>

        <!-- CARTÃO -->
        <div id="area_cartao" class="d-none mt-3">

            <div class="mb-3">
                <label>Número do cartão</label>
                <input type="text" name="num_cartao" class="form-control">
            </div>

            <div class="mb-3">
                <label>Nome no cartão</label>
                <input type="text" name="nome_cartao" class="form-control">
            </div>

            <div class="mb-3">
                <label>Validade</label>
                <input type="text" name="validade" class="form-control">
            </div>

            <div class="mb-3">
                <label>CVV</label>
                <input type="text" name="cvv" class="form-control">
            </div>

            <div class="mb-3">
                <label>Parcelas</label>
                <select name="parcelas" id="parcelas" class="form-control">
                    <option value="1">1x sem juros</option>
                    <option value="2">2x sem juros</option>
                    <option value="3">3x sem juros</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Valor por parcela</label>
                <input type="text" id="valor_parcela" class="form-control" readonly>
            </div>

        </div>

        <button class="btn btn-success w-100 mt-3">Confirmar Aluguel</button>

    </form>
</div>

<script src="../js/alugar.js"></script>

</body>
</html>
