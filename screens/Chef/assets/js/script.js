$(document).ready(function () {
    $.post("action.php",{flag:"getOrders"},function(data){
        $("#loader").fadeOut(function () {
            $(".wrapper").hide();
            $(".wrapper").fadeIn();
            $(".wrapper").css('display', 'block');
        });
        $("#content").append(data);
    });
});
function orderReady(orderId) {
    alert(orderId);
    console.log(orderId);
}