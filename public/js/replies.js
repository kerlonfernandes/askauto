
  // Adicione um evento de clique ao botão "Mostrar Respostas"
  const showHideButtons = document.querySelectorAll('.post__show-hide-button');
  showHideButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Encontre o elemento das respostas para o post correspondente
      const postBody = button.closest('.post__body');
      const postReplies = postBody.querySelector('.post__replies');

      // Verifique o estado atual das respostas (visíveis ou ocultas)
      const repliesHidden = postReplies.style.display === 'none';

      // Alterne a exibição das respostas com base no estado atual
      if (repliesHidden) {
        postReplies.style.display = 'block';
        button.textContent = 'Esconder Respostas';
      } else {
        postReplies.style.display = 'none';
        button.textContent = 'Mostrar Respostas';
      }
    });
  });


  