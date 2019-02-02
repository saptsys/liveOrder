$(document).ready(function(){
    /********************  AJAX  ****************** */
      
    establishTables();

    /*************************** JS ***********************/





    /*************************** UI ***********************/
});
var selectedTableName;
function establishTables() //its fetch tables and code of onclick on tables
{
    $("#loader").show();
    $.post("action.php",{flag:"getTable"},function(data){
        $("#loader").hide();
        $("#tables-container").html(data)
        $(".dining-table div").height($(".dining-table div").width()); //it makes width == height of table div
        var height = $(".dining-table").height();
        $(".arrows , .totalItemLabel").css({
            "margin-top":height/2+10+"px"
        });
        

        $(".dining-table div").click(function(){
            var name = $(this).children().first().html();
            if(name!=selectedTableName)
            {
                selectedTableName = $(this).children().first().html();
                obj = $(this).parent();
                $('.dining-table').not(obj).each(function(){
                    $(this).hide(500);
                });
                $(".backArrow").fadeIn();
                $(".forwardArrow").fadeIn();
            }
            tableSelected(selectedTableName);
        });
        $(".backArrow").click(function(){
            $(".forwardArrow").fadeOut();
            $("#tables-container .dining-table ").show(500);
            $(".backArrow").fadeOut();
            $("#menu-container").slideUp();
            $(".totalItemLabel b").html(totalItems=0);
            selectedProducts={};
            selectedTableName='';
        });
    });
}
var selectedTableId = selectedTableIsOcuupied = 0;
function setTableId(tableId) //call from tag
{
    selectedTableId = tableId;
    tId = "dining-table"+selectedTableId;
    if($("#"+tId).hasClass("Occupied"))
    {
        selectedTableIsOcuupied=1;
        showOrderedList(selectedTableId);
    }
}
function tableSelected(tableName) //its fetch catagories and products
{
    $("#loader").show();
    data="";
    $("#menu-container").slideDown();
    $.post("action.php",{flag:"getMenu"},function(data,status){
        if(status=="success"){
            $("#loader").hide();
            $("#menu-container").html(data);

            $(".catBox").click(function(){
                width = $(this).width();
                $(this).children("ul").slideDown();
                $(this).children("div").children("span").css({
                    "transform": "rotate(180deg)",
                    "padding-left":"10px"
                });
                $(this).children("ul").css({    
                    "min-width":width+"px"
                });

                $(".catBox").mouseleave(function(){
                    $(".catBox ul").slideUp();
                    $(this).children("div").children("span").css({
                        "transform": "rotate(0deg)",
                        "padding-left":"10px"
                    });
                });
            });
            $("#tables-container").click(function(){
                $(".catBox ul").slideUp();
            });
        }
        
    });

    $(".forwardArrow").click(function(){
        $(".counter").html(0);
        $(".totalItemLabel b").html(totalItems=0);
        if(!jQuery.isEmptyObject(selectedProducts))
        {
            $.ajax({
                type: "POST",
                url: "action.php",
                data: {
                    flag:"itemSelected",
                    selectedItems:selectedProducts,
                    tableId:selectedTableId
                },
                success: function(data){
                    tId = "dining-table"+selectedTableId;
                    $("#"+tId).addClass("Occupied");
                    $("#dialog").html("<p>"+data+"</p>").dialog({
                        modal: true,
                        buttons: {
                          Close: function() {
                            $( this ).dialog( "close" );
                            showOrderedList(selectedTableId);
                          }
                        },
                        width:320
                    });
                    selectedProducts={};
                }
            });
        }
    });

}
var selectedProducts = {}
var totalItems = 0;
function addQ(id){
    Qid="Q"+id;
    var val = 0;
    val = parseInt($("#"+Qid).html());
    if(val<10)
    {
        val++;
        $("#"+Qid).html(val);
        selectedProducts[id]=val;
        $(".totalItemLabel b").html(++totalItems);
    }
}
function subtractQ(id){
    Qid="Q"+id;
    var val = 0;
    val = parseInt($("#"+Qid).html());
    if(val>0)
    {
        val--;
        $("#"+Qid).html(val);
        selectedProducts[id]=val;
        $(".totalItemLabel b").html(--totalItems);
        if(val==0)
            delete selectedProducts[id];
    }
}

function showOrderedList(TId){

    $.ajax({
        type: "POST",
        url: "action.php",
        data: {
            flag:"getOrderedList",
            tableId:selectedTableId
        },
        success: function(data){
            $("#dialog").html("<p>"+data+"</p>").dialog({
                modal: true,
                buttons: {
                  Close: function() {
                    $( this ).dialog( "close" );
                  }
                },
                width:320
            });
        }
    });
}