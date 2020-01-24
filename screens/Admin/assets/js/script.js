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

$("#modelBody").on('click', '#productInputWrapper .removeProductInputForm', function(e){
    e.preventDefault()
    if($("#productInputWrapper").children().length !== 1){
        $('#productInputWrapper .removeProductInputForm').removeClass('removeProductInputForm').addClass('removeProductInputFormX');
           elem = $(this).parents('.productFormX').hide('fast', function() {
            elem.remove()
            $('#productInputWrapper .removeProductInputFormX').removeClass('removeProductInputFormX').addClass('removeProductInputForm');
       });
    } 
    else alert("can't delete last element")
});

$('#products').on('click', 'tr', function() {
    let param = $(this).attr('param').split(',');
    productClicked(param[0],param[1])
});
$("#modelBody").on('click', '#addProductInputBtn', function(e){addProductInputForm()});
$("#modelFooter").on('click', '#submitProductsBtn', function(e){submitProducts();});
$("#modelFooter").on('click', '#submitEditProductsBtn', function(e){submitProducts(true);});



$('#products').on('click','td .productEdit', function(e) {
    let id = $(this).attr('id')
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {id: id,flag:'getProductsObject'}
    })
    .done(function(res) {
        showEditProductModal($.parseJSON(res));
    })
    .fail(function() {
        console.log("error");
    })
    
    e.stopPropagation();
});

$('#products').on('click','td .productDelete', function(e) {
    if(confirm("Are You Sure.\nThis Action Can Not Be undone")){
        let id = $(this).attr('id')
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {flag: 'deleteProduct',id:id},
        })
        .done(function() {
            
        })
        $(this).parents('tr').hide('fast', function() {
                $(this).remove();
        });
    }

    e.stopPropagation();
});

function showEditProductModal(obj){
    console.log(obj)
    $.get('addProductModal.html', function(markup) {
        markup = $(markup)
        $('#ExtraBtnModal button').attr('id', 'submitEditProductsBtn');
        // markup.children('center').remove()
        markup.find('#catName').val(obj.category.name).attr('data', obj.category.id);

        productForm = $(markup.find("#productInputWrapper").html())
        markup.find("#productInputWrapper").html("")
        proForm = "";

        for(k in obj.products){
            productForm.find('.productX').attr({
                value: obj.products[k]['Name'],
                data:  obj.products[k]['Id']
            });
            productForm.find('.priceX').attr({
                value: obj.products[k]['Price'],
                data:  obj.products[k]['Id']
            });
            proForm += productForm.prop('outerHTML')
        }
        markup.find("#productInputWrapper").html(proForm)

        $("#modal #modelBody").html(markup)
        $("#modal").modal('show')
        $("#modal #modelHeader").html("Add Product")
    });
}


function submitProducts(edit=false){
    let productsList = {}
    productsList.isEdit = false
    productsList.catName = $('#catName').val();
    productsList.product = $("input[name='productNames[]']").map(function(){return $(this).val();}).get();
    productsList.prices = $("input[name='productPrices[]']").map(function(){return $(this).val();}).get();


    let ok=false;
    if(productsList.catName !== ""){
        for(i in productsList.product){
            if( (productsList.product[i] !== "") && (productsList.prices[i] !== "") ){
                ok=true;
                continue;
            }else{
                ok=false;
                break;
            }
        }
    }
    if(ok){
        if(edit){
            productsList.isEdit = true;
            productsList.proId = $('#catName').attr('data');
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {flag : 'submitEditProducts',
                       'data' : productsList
                   },
            })
            .done(function(data) {
                console.log(data);
                getProducts();
            })
            .fail(function() {
                console.log("error");
            })
        }else{
             $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {flag: 'submitProducts',
                       'data':productsList
                   },
            })
            .done(function(data) {
                console.log(data);
                getProducts();
            })
            .fail(function() {
                console.log("error");
            })
        }
        $('#modal').modal('hide');
    }else{
        alert("Invalid")
    }
}

function addProductInputForm(){

    let markup = $($("#productInputWrapper").children().last().prop('outerHTML'))
    let id = parseInt($(markup).attr('id').split('_')[1]) + 1
    markup.attr('id', 'form_'+id);
    markup.find('input').attr('value', '');
    // $("#addProductInputBtn").attr({id:'addProductInputBtnX',data:0});
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
        $('#ExtraBtnModal button').attr('id', 'submitProductsBtn');
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
                    'Print': function() {
                        $("#print_page_conainer").html(data);
                          $( this ).dialog( "close" );
                          window.print();
                          $("#print_page_conainer").html("");
                        //   $(".backArrow").trigger('click');
                          $("#printing_row").css("display","block");
                        },
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
                    



                    var file = $('#photo').get(0).files[0];
                    var fd = new FormData();

                    fd.append('flag',"updateUser")
                    fd.append('id',id)
                    fd.append('firstName',$("#firstName").val())
                    fd.append('lastName',$("#lastName").val())
                    fd.append('role',$("#role").find(":selected").text())
                    fd.append('password',$("#password").val())
                    fd.append('userName',$("#userName").val())
                    fd.append('file', file);
                    $.ajax({
                        url: "action.php",
                        error: function (e) {
                          console.log('error ' + e.message);
                        },
                        data: fd,
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data=="true") $("#dialog").dialog( "close" );
                        }   
                     });

                    
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
                    var file = $('#photo').get(0).files[0];
                    var fd = new FormData();

                    fd.append('flag',"addUserDB")
                    fd.append('firstName',$("#firstName").val())
                    fd.append('lastName',$("#lastName").val())
                    fd.append('role',$("#role").find(":selected").text())
                    fd.append('password',$("#password").val())
                    fd.append('userName',$("#userName").val())
                    fd.append('file', file);
                    $.ajax({
                        url: "action.php",
                        error: function (e) {
                          console.log('error ' + e.message);
                        },
                        data: fd,
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data=="true") $("#dialog").dialog( "close" );
                        }   
                     });


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