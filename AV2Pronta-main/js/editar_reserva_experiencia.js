document.addEventListener("DOMContentLoaded", () => {
    const select = document.getElementById("id_experiencia");
    const quantidade = document.getElementById("quantidade");
    const total = document.getElementById("valor_total");

    function calc() {
        const preco = parseFloat(select.options[select.selectedIndex].dataset.preco);
        const qty = parseInt(quantidade.value);

        if (!isNaN(preco) && qty > 0) {
            total.value = (preco * qty).toFixed(2);
        }
    }

    select.addEventListener("change", calc);
    quantidade.addEventListener("input", calc);

    calc();
});
