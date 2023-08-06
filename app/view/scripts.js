

document.addEventListener("DOMContentLoaded", function(event) {
  // Mostrar o spinner
  document.querySelector(".custom-loader").style.display = "block";

  // Quando o conteúdo da página for carregado
  window.addEventListener("load", function() {
    // Esconder o spinner
    document.querySelector(".custom-loader").style.display = "none";
  });
});


let perguntaArea = document.querySelector('#pergunta-area');


let commentBox = document.querySelector('#message-text').addEventListener('keydown', (e)=>{
    perguntaArea.value = e.target.value;

})  