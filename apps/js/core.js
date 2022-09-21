$(function() {
    $(".registerButton").click(function() {
        var name = $("input[name=registerFirstname]").val();
        var lastname = $("input[name=registerLastname]").val();
        var email = $("input[name=registerEmail]").val();
        var pass = $("input[name=registerPassword]").val();
        var registerButton = $("input[name=registerButton]").val();
        $.ajax({
            url: "class.function.php",
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
            url: "class.function.php",
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
});