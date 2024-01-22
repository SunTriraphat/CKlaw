<<<<<<< HEAD
var token = $("input[name='_token']").val();
=======
var token = $('input[name="_token"]').val();
>>>>>>> 89ef20e2b6c46c4da16736f879ddb511b6a08edf
$.sessionTimeout({
    keepAliveUrl:"homeside",
    logoutButton:"Logout",
<<<<<<< HEAD
    logoutUrl:"homeside",
    redirUrl:"",
    ajaxData:{_token:token},
    warnAfter:3e3,
    redirAfter:3e4,
=======
    logoutUrl:"logout",
    redirUrl:"dashboard",
    ajaxData: { _token:token}  ,
    warnAfter:5e3,
    redirAfter:5e4,
>>>>>>> 89ef20e2b6c46c4da16736f879ddb511b6a08edf
    countdownMessage:"Redirecting in {timer} seconds."
}),
$("#session-timeout-dialog  [data-dismiss=modal]").attr("data-bs-dismiss","modal");