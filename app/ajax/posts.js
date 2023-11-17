$(document).ready(function() {
    function consultarPostagem(postagem) {
        // Carregar o spinner no container
        $("#spinner-container").show();

        $.ajax({
            url: "usuarios-postagens.php",
            method: "GET",
            data: { postagem: postagem },
            success: function(data) {
                $(".postagens").html(data);
            },
            error: function() {
                console.error("Erro na requisição Ajax");
            },
            complete: function() {
                $("#spinner-container").hide();
            }
        });
    }

    // Carregar os resultados iniciais
    consultarPostagem('');

    $("#pesquisar-postagem").on("input", function() {
        let postagem = $(this).val();
        consultarPostagem(postagem);
    });
});
