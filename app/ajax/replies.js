$(document).ready(function() {
    function consultarPostagem() {
        // Carregar o spinner no container
        $("#spinner-container").show();

        $.ajax({
            url: "replies-consulta.php",
            method: "GET",
            success: function(data) {
                $(".respostas").html(data);
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
    consultarPostagem();

});
