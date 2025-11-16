
document.addEventListener("DOMContentLoaded", function() {
    const inicio = document.getElementById("data_inicio");
    const fim = document.getElementById("data_fim");
    const select = document.getElementById("id_acomodacao");
    const valorInput = document.getElementById("valor_total");

    function calc() {
        const vInicio = inicio.value;
        const vFim = fim.value;
        const option = select.options[select.selectedIndex];
        const preco = parseFloat(option?.dataset?.preco || 0);

        if (!vInicio || !vFim || !preco) {
            
            return;
        }

        const d1 = new Date(vInicio);
        const d2 = new Date(vFim);
        const diff = (d2 - d1) / (1000 * 60 * 60 * 24);

        if (diff > 0) {
            const total = diff * preco;
            valorInput.value = total.toFixed(2);
        } else {
           
            valorInput.value = "";
        }
    }

    inicio.addEventListener("change", calc);
    fim.addEventListener("change", calc);
    select.addEventListener("change", calc);

    calc();
});
