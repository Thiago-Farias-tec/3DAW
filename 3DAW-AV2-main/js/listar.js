
function carregarAcomodos() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "php/listar_acomodacoes.php", true);

    xhr.onload = function () {
        const dados = JSON.parse(this.responseText);
        let html = "";

        dados.forEach(item => {
            html += `
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="${item.imagem}" class="accommodation-img w-100">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title">${item.nome}</h4>
                        <p class="card-text flex-grow-1">${item.descricao}</p>
                        <p class="price fs-5">R$ ${item.preco} / noite</p>
                        <button class="btn btn-primary mt-2" onclick='alugar(${item.id})'>
                            Alugar Agora
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
        window.location.href = "alugar.php?id=" + id;
    }
}
