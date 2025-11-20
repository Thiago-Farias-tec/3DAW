function carregarAcomodos() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/listar_acomodacoes.php", true);

    xhr.onload = function () {
        const dados = JSON.parse(this.responseText);
        let html = "";

        dados.forEach(item => {
            html += `
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="${item.imagem}" class="accommodation-img w-100">
                    <div class="p-3">
                        <h4>${item.nome_formatado}</h4>
                        <p>${item.descricao}</p>
                        <button class="btn btn-primary mt-2" onclick='alugar(${item.id})'>
                            Alugar
                        </button>
                    </div>
                </div>
            </div>`;
        });

        document.getElementById("lista").innerHTML = html;
    };

    xhr.send();
}

function alugar(id) {
    if (confirm("Deseja continuar com o aluguel?")) {
        window.location.href = "../php/alugar.php?id=" + id;
    }
}
