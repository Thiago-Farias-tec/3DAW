<?php
$arquivo = "disciplinas.txt";

/* ---------------- SALVAR OU ALTERAR ---------------- */
if(isset($_POST['acao'])){
    $nome  = $_POST["nome"];
    $sigla = $_POST["sigla"];
    $carga = $_POST["carga"];

    if(!file_exists($arquivo)){
        file_put_contents($arquivo, "nome;sigla;carga\n");
    }

    if($_POST['acao'] == "salvar"){
        file_put_contents($arquivo, "$nome;$sigla;$carga\n", FILE_APPEND);
    }

    if($_POST['acao'] == "alterar" && isset($_POST['id'])){
        $linhas = file($arquivo);
        $linhas[$_POST['id']] = "$nome;$sigla;$carga\n";
        file_put_contents($arquivo, implode("", $linhas));
    }
}

/* ---------------- EXCLUIR ---------------- */
if(isset($_GET['del'])){
    $linhas = file($arquivo);
    unset($linhas[$_GET['del']]);
    file_put_contents($arquivo, implode("", $linhas));
}

/* ---------------- PEGAR DADOS PARA ALTERAR ---------------- */
$editar = null;
if(isset($_GET['edit'])){
    $linhas = file($arquivo);
    if(isset($linhas[$_GET['edit']])){
        $dados = explode(";", trim($linhas[$_GET['edit']]));
        if(count($dados) >= 3){
            $editar = [
                'id' => $_GET['edit'],
                'nome' => $dados[0],
                'sigla' => $dados[1],
                'carga' => $dados[2]
            ];
        }
    }
}
?>

<form method="post">
    <input type="hidden" name="acao" value="<?= $editar ? 'alterar' : 'salvar' ?>">
    <?php if($editar): ?>
        <input type="hidden" name="id" value="<?= $editar['id'] ?>">
    <?php endif; ?>

    Nome:  <input name="nome" value="<?= $editar['nome'] ?? '' ?>"><br>
    Sigla: <input name="sigla" value="<?= $editar['sigla'] ?? '' ?>"><br>
    Carga: <input name="carga" type="number" value="<?= $editar['carga'] ?? '' ?>"><br>
    <button><?= $editar ? 'Alterar' : 'Salvar' ?></button>
</form>

<hr>

<?php
if(file_exists($arquivo)){
    $linhas = file($arquivo);
    foreach($linhas as $i => $linha){
        if($i == 0) continue; // pula cabeçalho
        $d = explode(";", trim($linha));
        if(count($d) < 3) continue;
        echo "$d[0] | $d[1] | $d[2] ".
             "<a href='?edit=$i'>Alterar</a> | ".
             "<a href='?del=$i' onclick=\"return confirm('Excluir?')\">Excluir</a><br>";
    }
} else {
    echo "Nenhuma disciplina cadastrada.";
}
?>
