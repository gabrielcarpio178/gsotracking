$(document).ready(()=>{

    $("#forgot_password").on('submit',e=>{
        e.preventDefault()
        var email =  $("#input_email").val();
        sendEmail(email);

    })

})

function sendEmail(email){
    $.ajax({
        url: 'logic/sendEmailForgotPassword.php',
        type: 'POST',
        data: {
            email
        },
        cache: false,
        beforeSend: ()=>{
            $("#loader_div").css('display', 'block');
        },
        success: res=>{
            $("#loader_div").css('display', 'none');
            if(res==="not found email"){
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Email Not Found",
                    showConfirmButton: false,
                    timer: 1000
                });
            }else{
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Check OTP to your Email",
                    showConfirmButton: false,
                    timer: 1000
                }).then(()=>{
                    window.location = "insertOtp.php";
                })
            }
        }
    })
}