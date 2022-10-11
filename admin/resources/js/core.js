$(document).on("click", '.deleteBtn', function(e) {
    e.preventDefault();
    var data = $("button[name=delete]").val();
    var key = $(this).attr('id');
    deleteSupport(data,key);
});
$(document).on("click", '.endBtn', function(e) {
    e.preventDefault();
    var data = $("button[name=endBtn]").val();
    var key = $(this).attr('id');
    endSupport(data,key);
});

$(document).on("click", '.openBtn', function(e) {
    e.preventDefault();
    var data = $("button[name=openBtn]").val();
    var key = $(this).attr('id');
    openSupport(data,key);
});

$(document).on("click", '.sendMessageTicket', function(e) {
    e.preventDefault();
    var data = $("button[name=sendMessageTicket]").val();
    var key = $(this).attr('id');
    sendMessageTicket(data,key);
});

function sendMessageTicket(data,key) {
    if (confirm(key+" Mesajı göndermek istiyor musunuz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "sendMessageTicket": data
        },
        success: function (sonuc) {
            $('#callback').html('<div class="alert alert-success w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
            yenile(data);
        }        
    });
}
}

function supportyenile(data){
    var frame = $(".box-area").attr('id');
    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "frame": frame,
            "supportyenile": data,
        },
        success: function (msg) {
            $(".box-area").html(msg);
        }
    });
}

function openSupport(data,key) {
    if (confirm(key+" Talebi açmak istiyor musunuz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "openSupport": data
        },
        success: function (sonuc) {
            $('#callback').html('<div class="alert alert-success w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
            yenile(data);
        }        
    });
}
}

function endSupport(data,key) {
    if (confirm(key+" Talebi sonlandırmak istiyor musunuz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "endSupport": data
        },
        success: function (sonuc) {
            $('#callback').html('<div class="alert alert-success w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
            yenile(data);
        }        
    });
}
}

function deleteSupport(data,key) {
    if (confirm(key+" Numaralı Datayı Silmeye Emin Misiniz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "deleteSupport": data
        },
        success: function (sonuc) {
            $('#callback').html('<div class="alert alert-success w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
            yenile(data);
        }        
    });
}
}


function yenile(data){
    var frame = $(".dataCenter").attr('id');
    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "frame": frame,
            "yenile": data,
        },
        success: function (msg) {
            $(".dataCenter").html(msg);
        }
    });
}