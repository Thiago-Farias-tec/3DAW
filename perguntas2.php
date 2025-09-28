<?php
$arquivo = "perguntas_texto.txt";

if(isset($_POST['acao'])){
    $pergunta = $_POST['pergunta'];
    $resposta = $_POST['resposta'];

    if(!file_exists($arquivo)){
        file_put_contents($arquivo, "pergunta;resposta\n");
    }

    if($_POST['acao'] == "salvar"){
        file_put_contents($arquivo, "$pergunta;$resposta\n", FILE_APPEND);
    }

    if($_POST['acao'] == "alterar" && isset($_POST['id'])){
        $linhas = file($arquivo);
        $linhas[$_POST['id']] = "$pergunta;$resposta\n";
        file_put_contents($arquivo, implode("", $linhas));
    }
}

if(isset($_GET['del'])){
    $linhas = file($arquivo);
    unset($linhas[$_GET['del']]);
    file_put_contents($arquivo, implode("", $linhas));
}

$editar = null;
if(isset($_GET['edit'])){
    $linhas = file($arquivo);
    if(isset($linhas[$_GET['edit']])){
        $dados = explode(";", trim($linhas[$_GET['edit']]));
        if(count($dados) >= 2){
            $editar = [
                'id' => $_GET['edit'],
                'pergunta' => $dados[0],
                'resposta' => $dados[1]
            ];
        }
    }
}
?>
<h2>Perguntas de Texto</h2>
<form method="post">
<input type="hidden" name="acao" value="<?= $editar ? 'alterar' : 'salvar' ?>">
<?php if($editar): ?><input type="hidden" name="id" value="<?= $editar['id'] ?>"><?php endif; ?>

Pergunta: <input name="pergunta" value="<?= $editar['pergunta'] ?? '' ?>"><br>
Resposta esperada: <input name="resposta" value="<?= $editar['resposta'] ?? '' ?>"><br>
<button><?= $editar ? 'Alterar' : 'Salvar' ?></button>
</form>

<hr>
<?php
if(file_exists($arquivo)){
    $linhas = file($arquivo);
    foreach($linhas as $i => $linha){
        if($i == 0) continue;
        $d = explode(";", trim($linha));
        if(count($d) < 2) continue;
        echo "<b>$d[0]</b> | Resp: $d[1] ".
             "<a href='?edit=$i'>Alterar</a> | ".
             "<a href='?del=$i' onclick=\"return confirm('Excluir?')\">Excluir</a><br>";
    }
}else{
    echo "Nenhuma pergunta cadastrada.";
}
?>
