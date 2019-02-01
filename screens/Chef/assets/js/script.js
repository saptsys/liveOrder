$(document).ready(function () {
    getData("getOrders");
    setInterval(() => {
        getData("getOrders",false);
    }, 5000);
});
function getData(flag,firstTime=true) { 
    console.log("dbchecked");
    $.post("action.php",{flag:flag},function(data){
        if(firstTime){
            $("#loader").fadeOut(function () {
                $(".wrapper").hide();
                $(".wrapper").fadeIn();
                $(".wrapper").css('display', 'block'); 
            });
        }
        $("#content").html(data);
    });
}
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