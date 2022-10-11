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
    var sendmessage = $("input[name=ticket-message]").val();
    var key = $(this).attr('id');
    sendMessageTicket(data,key,sendmessage);
});

function sendMessageTicket(data,key,sendmessage) {
    if (confirm(key+" Mesajı göndermek istiyor musunuz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "message": sendmessage,
            "sendMessageTicket": data
        },
        success: function (sonuc) {
            $('#callback').html('<div class="alert alert-success w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
            supportyenile(data,key);
        }        
    });
}
}

function supportyenile(data,key){
    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "id": key,
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
            // su(data);
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