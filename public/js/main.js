$(document).ready(function() {
    $(".btn-actualizar").on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        console.log(id);
        var href = $(this).data("href");
        var cantidad = $("#producto_" + id).val();
        console.log(cantidad);

        window.location.href = href + "/" + cantidad;
    });
});
