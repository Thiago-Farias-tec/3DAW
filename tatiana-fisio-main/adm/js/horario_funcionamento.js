function salvarHorario() {
  const form = document.querySelector('#form-horarios');
  const formData = new FormData(form);
console.log(window.location.href);

  fetch('../php/salvar_horario.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(msg => {
    alert(msg);
    window.location.href = "dias_de_fechamento.html"; 
})

  .catch(err => {
    alert('Erro ao salvar horários: ' + err);
  });
}
