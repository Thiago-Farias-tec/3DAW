document.addEventListener("DOMContentLoaded", () => {
    const select = document.getElementById("id_aula");
    const qtd = document.getElementById("quantidade");
    const total = document.getElementById("valor_total");

    function calc() {
        const preco = parseFloat(select.options[select.selectedIndex].dataset.preco);
        const q = parseInt(qtd.value);

        if (!isNaN(preco) && !isNaN(q)) {
            total.value = (preco * q).toFixed(2);
        }
    }

    select.addEventListener("change", calc);
    qtd.addEventListener("input", calc);

    calc();
});
