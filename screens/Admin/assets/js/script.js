$(document).ready(function () {
    // getUsers();
    // getTables();
    // getInvoices(); 
    getProducts();
    // setInterval(() => {
    //     getUsers();
    //     getTables();
    // }, 5000);
    // setInterval(() => {
    //     getInvoices();
    // }, 10000);
});


$("#modelBody").on('click', '#productInputWrapper .removeProductInputForm', function(e){
    e.preventDefault()
    if($("#productInputWrapper").children().length !== 1){
       elem = $(this).parents('.productFormX').hide('fast', function() {
           elem.remove()
       });
    } 
    else alert("can't delete last element")
});


$('#products').on('click', 'tr', function() {
    let param = $(this).attr('param').split(',');
    productClicked(param[0],param[1])
});

$('#products').on('click','td button', function(e) {
    alert($(this).attr('id'))
    e.stopPropagation();
});

$("#modelBody").on('click', '#addProductInputBtn', function(e){
    addProductInputForm()
});

$("#modelFooter").on('click', '#submitProductsBtn', function(e){
    submitProducts();
});

function submitProducts(){
    let productsList = {}
    productsList.catName = $('#catName').val();
    productsList.product = $("input[name='productNames[]']").map(function(){return $(this).val();}).get();
    productsList.prices = $("input[name='productPrices[]']").map(function(){return $(this).val();}).get();
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {flag: 'submitProducts',
               'data':productsList
           },
    })
    .done(function(data) {
        console.log(data);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
        
}

function addProductInputForm(){

    let markup = $($("#productInputWrapper").children().last().prop('outerHTML'))
    let id = parseInt($(markup).attr('id').split('_')[1]) + 1
    markup.attr('id', 'form_'+id);
    $("#addProductInputBtn").attr('id', 'addProductInputBtnX');
    markup.hide().appendTo('#productInputWrapper').show('fast', function() {
        let wtf = $('#productInputWrapper');
        wtf.scrollTop(wtf[0].scrollHeight);
        $("#addProductInputBtnX").attr('id', 'addProductInputBtn');
    });

        
}

function addProducts(){
    $.get('addProductModal.html', function(data) {
        $("#modal #modelBody").html(data)
        $("#modal").modal('show')
        $("#modal #modelHeader").html("Add Product")
    });

}

function productClicked(id,name){         
   try{
    $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                flag: 'getAllProducts',
                id: id,
                catName:name
            },
        })
        .done(function(data) {
            $("#dialog").html(data);
            $("#dialog").animate({scrollTop:0},10);
            $('#dialog').dialog({
                open : function() {
                    $('#dialog').dialog( "option" , "title" ,name);
                },
                buttons: {
                    'Close': function() {
                      $( this ).dialog( "close" );
                    }
                },
                width:320,
                maxHeight:400
            });
            // $("#modal #modelBody").html(data)
            // $("#modal #modelHeader").html(name)
            // $("#modal").modal('show');
        }).fail(function(data) {
            console.log(data);
        })
        .always(function() {
            console.log("getAllProducts load complete");
        });
   }catch(e){
       console.log(e)
   }finally{
       console.log("getAllProducts load finally complete");
   }
}

function getProducts(){
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {flag: 'getProducts'},
    })
    .done(function(data) {
       $("#products").html(data)
    }).fail(function() {
        console.log("error");
        })
    .always(function() {
        console.log("products load complete");
    });
    
}

function getInvoices(){
    $.post("action.php", {flag:'getInvoices'},
        function (data) {            
            $("#invoiceContent").html(data);
        },
    );
}
function viewInvoice(id){
    $.post("action.php", {
            flag:'getInvoiceData',
            id:id
        },
        function (data) { 
            $("#dialog").html(data);
            $("#dialog").animate({scrollTop:0},10);
            $('#dialog').dialog({
                open : function() {
                    $('#dialog').dialog( "option" , "title" ,"Invoice");
                },
                buttons: {
                    'Close': function() {
                      $( this ).dialog( "close" );
                    }
                },
                width:320,
                maxHeight:400
            });
            $("#dialog").animate({scrollTop:1000},1000);
        },
    );
}
function getUsers() { 
    $.post("action.php",{flag:"getUsers"},function(data){
        $("#userContent").html(data);
    });
}
function getTables() { 
    $.post("action.php",{flag:"getTables"},function(data){
        $("#tableContent").html(data);
    });
}
function editUser(id){
    $.post("action.php",{flag:"editUser",id:id},function(data){
        $("#dialog").html(data);
        $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Edit User");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {
                        flag:"updateUser",
                        id:id,
                        firstName:$("#firstName").val(),
                        lastName:$("#lastName").val(),
                        role:$("#role").find(":selected").text(),
                        password:$("#password").val(),
                        userName:$("#userName").val()
                    },
                        function (data) {
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
    });
}
function editTable(id){
    $.post("action.php",{flag:"editTable",id:id},function(data){
        $("#dialog").html(data);
        $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Edit Table");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {
                        flag:"updateTable",
                        id:id,
                        tblName:$("#tblName").val(),
                        capacity:$("#capacity").val()
                    },
                        function (data) {
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
    });
}
function addUser (showDialog=true){
    if(showDialog){
        $.post("action.php",{flag:"addUser"},function(data){
            $("#dialog").html(data);
            $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Add User");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {
                            flag:"addUserDB",
                            firstName:$("#firstName").val(),
                            lastName:$("#lastName").val(),
                            role:$("#role").find(":selected").text(),
                            password:$("#password").val(),
                            userName:$("#userName").val()
                        },
                        function (data) {
                            if(data=="true") $("#dialog").dialog( "close" );
                        }
                    );
                }
            }
        });
        });
    }else{
        $.post("action.php",{flag:"addUserDB"},function(data){
        });
    }
}
function addTable(flag=false){
    $.post("action.php",{flag:"addTable"},function(data){
        $("#dialog").html(data);
        $('#dialog').dialog({
            open : function() {
                $('#dialog').dialog( "option" , "title" ,"Add Table");
            },
            buttons: {
                Submit: function() {
                    $.post("action.php", {
                        flag:"addTableDB",
                        tblName:$("#tblName").val(),
                        capacity:$("#capacity").val(),
                    },
                    function (data) {
                        if(data=="true") $("#dialog").dialog( "close" );
                    }
                    );
                }
            }
        });
    });
}
function deleteUser (id){
    $.post("action.php",{flag:"deleteUser",id:id},function(data){
        if(data=="1") $("#user"+id).fadeOut();
    });
}
function deleteTable (id){
    $.post("action.php",{flag:"deleteTable",id:id},function(data){
        if(data=="1") $("#table"+id).fadeOut();
    });
}