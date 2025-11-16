<?php
require "conexao.php";

$id = $_GET['id'];

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
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Alugar: <?php echo $acomodacao['nome']; ?></h2>

    <form action="processa_aluguel.php" method="POST" class="card p-4">

        <input type="hidden" name="id_acomodacao" value="<?php echo $acomodacao['id']; ?>">
        <input type="hidden" id="preco" value="<?php echo $acomodacao['preco']; ?>">

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

        <button class="btn btn-success w-100">Confirmar Aluguel</button>

    </form>
</div>

<script>
function calcular() {
    let inicio = document.getElementById("inicio").value;
    let fim = document.getElementById("fim").value;
    let preco = document.getElementById("preco").value;

    if (inicio && fim) {
        let d1 = new Date(inicio);
        let d2 = new Date(fim);
        let dias = (d2 - d1) / (1000 * 60 * 60 * 24);

        if (dias > 0) {
            document.getElementById("valor").value = (dias * preco).toFixed(2);
        }
    }
}

document.getElementById("inicio").addEventListener("change", calcular);
document.getElementById("fim").addEventListener("change", calcular);
</script>

</body>
</html>
