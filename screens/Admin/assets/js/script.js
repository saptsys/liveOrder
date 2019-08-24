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

$('#products').on('click', 'tr', function() {
    param = $(this).attr('param').split(',');
    productClicked(param[0],param[1])
});

$('#products').on('click','td button', function(e) {
    alert($(this).attr('id'))
    e.stopPropagation();
});


$("#addProductInputBtn").click(function(event) {
   addProductInputForm()
});


function addProductInputForm(){
    markup = `   
      <div class="col-md-12 col-sm-12 col-xs-12 productFormX">
        <div class="col-md-9 col-sm-9 col-xs-12">
          <label class=control-label>Product</label>
          <input class="form-control" id="pro1" type="text" placeholder="Product1">
        </div>
        <div class="col-md-2  col-sm-2 col-xs-6 ">
          <label class=control-label>Price</label>
          <input class="form-control" id="pri1" type="text" placeholder="Price1">
        </div>
        <div class="col-md-1  col-sm-1 col-xs-1 ">
          <label class=control-label>Remove</label>
          <button onclick="removeProductInputForm()" style="text-align:center" type="button"  class="form-control btn btn-primary">
            <i class="fa fa-lg fa-trash"></i>
          </button>
        </div>
      </div>
      `
      markup = $("#productInputWrapper :last-child").html()
      console.log(markup)
    $("#productInputWrapper").append(markup)
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