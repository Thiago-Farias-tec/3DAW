<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form action="" method="post">
        <label for="num1">Número 1:</label>
        <input type="number" id="num1" name="num1" required><br><br>

        <label for="num2">Número 2:</label>
        <input type="number" id="num2" name="num2" required><br><br>

        <label for="operador">Operador:</label>
        <select id="operador" name="operador" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br><br>

        <button type="submit">Calcular</button>
    </form>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $operador = $_POST["operador"];
        $resultado = 0;

        switch ($operador) {
            case '+':
                $resultado = $num1 + $num2;
                break;
            case '-':
                $resultado = $num1 - $num2;
                break;
            case '*':
                $resultado = $num1 * $num2;
                break;
            case '/':
                if ($num2 != 0) {
                    $resultado = $num1 / $num2;
                } else {
                    echo "Não dá pra dividir por zero!";
                    exit;
                }
                break;
        }

        echo "<h3>Resultado: $resultado</h3>";
    }
    ?>

</body>
</html>