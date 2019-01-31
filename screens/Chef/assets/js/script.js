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
    $.post("action.php",{flag:"orderReady",id:orderId},function(data){
        $("#row"+orderId).fadeOut();
    });
}
function orderDeclined(orderId) {
    $.post("action.php",{flag:"orderDeclined",id:orderId},function(data){
        $("#row"+orderId).fadeOut();
    });
}