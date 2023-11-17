$(document).ready(function() {
    $('#custom-checkbox').click(function() {
        // Verifique se a checkbox está marcada ou desmarcada
        var isChecked = $(this).is(':checked');
        
        // Obtenha o valor do atributo data-id
        var dataId = $(this).data('id');

        // Faça uma solicitação AJAX para o servidor
        $.ajax({
            url: 'like.php', // Substitua 'seu_script.php' pelo caminho do seu script PHP
            type: 'POST',
            data: {
                isChecked: isChecked,
                dataId: dataId
            },
            success: function(response) {
                // Aqui você pode lidar com a resposta do servidor, se necessário
                console.log(response);
            },
            error: function() {
                console.error('Erro na requisição AJAX');
            }
        });
    });
});