$(document).ready(()=>{
    $("#form_content").on('submit', e=>{
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        if(username.length != 0|| password.length != 0){
            $.ajax({
                url: 'logic/login_script.php',
                type: 'POST',
                data: {
                    email: username,
                    password: password
                },
                cache: false,
                beforeSend: ()=>{
                    $("#loader_div").css('display', 'block');
                },
                success: res=>{
                    $("#loader_div").css('display', 'none');
                    if(res=="invalid_credential"){
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Incorrect password or email",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }else if(res=="deactivated"){
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Your account deactived",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }else{
                        window.location = res;
                    }
                }
            })
        }
    })

    $("#btn_eye").on('click', ()=>{
        var x = document.getElementById("password");
    
        if (x.type === "password") {
            x.type = "text";
            $("#btn_eye").removeClass("fa-eye");
            $("#btn_eye").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $("#btn_eye").addClass("fa-eye");
            $("#btn_eye").removeClass("fa-eye-slash");
        }
    })
})