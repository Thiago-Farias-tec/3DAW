document.addEventListener("DOMContentLoaded", () => {
    const selectAula = document.getElementById("aula");
    const inputQuantidade = document.getElementById("quantidade");
    const inputTotal = document.getElementById("total");
    const form = document.getElementById("formAula");

    function atualizarTotal() {
        const preco = parseFloat(selectAula.selectedOptions[0]?.getAttribute("data-preco")) || 0;
        const qtd = parseInt(inputQuantidade.value) || 0;

        if (preco > 0 && qtd > 0) {
            inputTotal.value = (preco * qtd).toFixed(2);
        } else {
            inputTotal.value = "";
        }
    }

    selectAula.addEventListener("change", atualizarTotal);
    inputQuantidade.addEventListener("input", atualizarTotal);

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        if (!confirm("Confirmar reserva?")) return;

        const formData = new FormData(form);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "registrar_aula.php", true);

        xhr.onload = () => {
            const resp = xhr.responseText.trim();

            if (resp.includes("OK")) {
                alert("Reserva realizada com sucesso!");

                // 🔥 REDIRECIONA APÓS O SUCESSO
                window.location.href = "../index.html"; 
                // se o arquivo estiver na raiz, use:
                // window.location.href = "index.html";
            } else {
                alert("Erro: " + resp);
            }
        };

        xhr.onerror = () => alert("Erro de conexão.");
        xhr.send(formData);
    });

    atualizarTotal();
});
