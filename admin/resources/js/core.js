$(document).on("click", '.deleteBtn', function(e) {
    e.preventDefault();
    var remove = $("button[name=delete]").val();
    var key = $(this).attr('id');
    removeData(remove,key);
});

function removeData(remove,key) {
    if (confirm(key+" Numaralı Datayı Silmeye Emin Misiniz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "removeData": remove
        },
        success: function (sonuc) {
            $('#callback').html('<div class="alert alert-success w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
            yenile(remove);
        }        
    });
}
}

function yenile(remove){
    var frame = $(".dataCenter").attr('id');
    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "frame": frame,
            "yenile": remove,
        },
        success: function (msg) {
            $(".dataCenter").html(msg);
        }
    });
}