$(document).ready(function () {
    getUsers();
    getTables();
    getInvoices();
    getProducts();
    setInterval(() => {
        getUsers();
        getTables();
    }, 5000);
    setInterval(() => {
        getInvoices();
    }, 10000);
});


async function productClicked(id,name){
   try{
    await $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                flag: 'getAllProducts',
                id: id,
                catName:name
            },
        })
        .done(function(data) {
           $("#modal #modelBody").html(data)
           $("#modal #modelHeader").html(name)
           $("#modal").modal('show');
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