$(document).on("click", '.deleteBtn', function(e) {
    e.preventDefault();
    var data = $("button[name=delete]").val();
    var key = $(this).attr('id');
    deleteSupport(data,key);
});

$(document).on("click", '.updateUser', function(e) {
    e.preventDefault();
    var data = $("button[name=updateUser]").val();
    var key = $(this).attr('id');
    updateUser(data,key);
});

$(document).on("click", '.updateDepartman', function(e) {
    e.preventDefault();
    var data = $("button[name=updateDepartman]").val();
    var key = $(this).attr('id');
    updateDepartman(data,key);
});
$(document).on("click", '.departmanadd', function(e) {
    e.preventDefault();
    var data = $("button[name=departmanadd]").val();
    var key = $(this).attr('id');
    addDepartman(data,key);
});

$(document).on("click", '.usersil', function(e) {
    e.preventDefault();
    var data = $("button[name=usersil]").val();
    var key = $(this).attr('id');
    userDelete(data,key);
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
                $("#ticket-message").html("");
                sendmessage =='';
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
            $(".box-area-message").html(msg);
        }
    });
}

function updateUser(data,key){
    var name = $("input[name=name]").val();
    var surname = $("input[name=surname]").val();
    var email = $("input[name=email]").val();
    var permission = $( "#permission" ).val();
    var department = $( "#department" ).val();

    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "name": name,
            "surname": surname,
            "email": email,
            "permission": permission,
            "department": department,

            "id": key,
            "updateAccount": data,
        },
        success: function (msg) {
            $("#callback").html(msg);
        }
    });
}

function userDelete(data,key){
    if (confirm(key+" Kullanıcıyı silmeyi onaylıyor musunuz ?")) {
    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "id": key,
            "userDelete": data,
        },
        success: function (msg) {
            $("#callback").html(msg);
        }
    });
    }
}

function updateDepartman(data,key){
    var departments = $("select[name=departments]").val();

    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "id": key,
            "departments": departments,
            "updateDepartman": data,
        },
        success: function (msg) {
            $("#callback").html(msg);
        }
    });
}
function addDepartman(data,key){
    var name = $("input[name=departmanname]").val();

    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "department": name,
            "addDepartman": data,
        },
        success: function (msg) {
            $("#callback").html(msg);
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
$(document).ready(function() {
    var refreshTimer = setInterval(()=> {
    var data = $("input[name=root]").val();
    var key = $(".root").attr('id');
    supportyenile(data,key)
    },5000);
});