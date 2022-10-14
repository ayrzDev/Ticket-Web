$(document).on("click", '.deleteSupport', function(e) {
    e.preventDefault();
    var data = $("button[name=deleteSupport]").val();
    var key = $(this).attr('id');
    deleteSupport(data,key);
});

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
            yenilesuppordata(data);
        }        
    });
}
function yenilesuppordata(data,key){
    $.ajax({
        type:'POST',
        url: "/functions/functionBase.php",
        data: {
            "id": key,
            "supportDataYenile": data,
        },
        success: function (msg) {
            $("#userSupports").html(msg);
            // $('.messages-box').scrollTop($('.messages-box')[0].scrollHeight);
        }
    });
}
}

$(document).on("click", '.sendMessage', function(e) {
    e.preventDefault();
    var data = $("button[name=sendMessage]").val();
    var sendmessage = $("input[name=ticket-message]").val();
    var key = $(this).attr('id');
    sendMessage(data,key,sendmessage);
});

function sendMessage(data,key,sendmessage) {
    if (confirm(key+" Mesajı göndermek istiyor musunuz ?")) {
    $.ajax({
        url: "/functions/functionBase.php",
        type: "POST",
        data: {
            "key": key,
            "message": sendmessage,
            "sendMessage": data
        },
        success: function (sonuc) {         
            if(sonuc == null || sonuc == ''){
            }else{
                $('#callback').html('<div class="alert alert-secondary w-100  text-center" id="fadeAlert">'+ sonuc+'</div>');
                supportyenile(data,key);
            }
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
            "usersupportyenile": data,
        },
        success: function (msg) {
            $(".messages-box").html(msg);
            // $('.messages-box').scrollTop($('.messages-box')[0].scrollHeight);
        }
    });
}

$(function() {
    $(".registerButton").click(function() {
        var name = $("input[name=registerFirstname]").val();
        var lastname = $("input[name=registerLastname]").val();
        var email = $("input[name=registerEmail]").val();
        var pass = $("input[name=registerPassword]").val();
        var registerButton = $("input[name=registerButton]").val();
        $.ajax({
            url: "functions/class.function.php",
            type: "POST",
            data: {
                "name": name,
                "lastname": lastname,
                "email": email,
                "password": pass,
                "registerBtn": registerButton
            },
            success: function(sonuc) {
                $(".process").html(sonuc);
                if(name == null || name == ""){
                    $(".nameErr").html("Lütfen bu alanı boş bırakmayınız.");
                }else{
                    $(".nameErr").html("");
                }
                if(lastname == null || lastname == ""){
                    $(".lastnameErr").html("Lütfen bu alanı boş bırakmayınız.");
                }else{
                    $(".lastnameErr").html("");
                }
                if(email == null || email == ""){
                    $(".emailErr").html("Lütfen bu alanı boş bırakmayınız.");
                }else{
                    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

                    if (email.match(validRegex)) {
                        $(".emailErr").html("");
                    }else{
                        $(".emailErr").html("Doğru Email Yazınız");
                    }
                }
                if(pass == null || pass == ""){
                    $(".passErr").html("Lütfen bu alanı boş bırakmayınız.");
                    
                }else{
                    $(".passErr").html("");
                }
            }
        })
    });
    $(".loginBtn").click(function() {
        var email = $("input[name=loginEmail]").val();
        var password = $("input[name=loginPassword]").val();
        var loginBtn = $("input[name=loginBtn]").val();
        $.ajax({
            url: "functions/class.function.php",
            type: "POST",
            data: {
                "email": email,
                "password": password,
                "loginBtn": loginBtn
            },
            success: function(sonuc) {
                $(".process").html(sonuc);

                if(email == null || email == ""){
                    $(".emailErr").html("Lütfen bu alanı boş bırakmayınız.");
                }else{
                    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

                    if (email.match(validRegex)) {
                        $(".emailErr").html("");
                    }else{
                        $(".emailErr").html("Doğru Email Yazınız");
                    }
                }
                if(password == null || password == ""){
                    $(".passErr").html("Lütfen bu alanı boş bırakmayınız.");
                    
                }else{
                    $(".passErr").html("");
                }
            }
        });
    });
    $(".role-add").click(function() {
        var name = $("input[name=role-name]").val();
        var roleadd = $("input[name=role-add]").val();
        $.ajax({
            url: "../functions/class.function.php",
            type: "POST",
            data: {
                "roleName": name,
                "roleAdd": roleadd
            },
            success: function(sonuc) {
                $(".process").html(sonuc);
                if(name == null || name == ""){
                    $("#error").addClass("alert alert-danger");
                    $(".error").html("Lütfen boş alan bırakmayınız.");
                }else{
                    $("#error").removeClass("alert alert-success");
                }
            }
        });
    });
    
    $(".supportadd").click(function() {
        var title = $("input[name=title]").val();
        var departments = $("select[name=departments]").val();
        var message = CKEDITOR.instances.editor1.getData();
        var supportadd = $("input[name=supportadd]").val();
        $.ajax({
            url: "functions/class.function.php",
            type: "POST",
            data: {
                "title": title,
                "departments": departments,
                "message": message,
                "supportadd": supportadd
            },
            success: function(sonuc) {
                $(".process").html(sonuc);
                if (title == "" && message == "") {
                    $(".process").addClass("alert alert-danger");
                    $(".process").html("Lütfen boş alan bırakmayınız.");   
                }
                if (departments == 0) {
                    $(".process").addClass("alert alert-danger");
                    $(".process").html("Departman seçiniz.");   
                }

                if (departments != 0 && title != "" && message != "") {
                    $(".process").removeClass("alert alert-danger");
                    $(".process").addClass("alert alert-success");
                }
            }
        });
    });
});

$(document).ready(function() {
    if ($("div").hasClass("messages-box")) {
    $('.messages-box').scrollTop($('.messages-box')[0].scrollHeight);
    var data = $("input[name=root]").val();
    var key = $(".root").attr('id');
    var refreshTimer = setInterval(()=> {
        supportyenile(data,key)
    },1000);
}
});