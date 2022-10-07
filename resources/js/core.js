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