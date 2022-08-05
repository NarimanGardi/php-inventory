/*=============================================
local Storage check
=============================================*/
if (localStorage.getItem("captureRange") != null) {
    $("#daterange-btn span").html(localStorage.getItem("captureRange"));
} else {
    $("#daterange-btn span").html('<span><i class="fa fa-calendar"> </i>  بەرواری فرۆشتن</span>');
}



/*=============================================
datatable in json
=============================================*/

// $.ajax({
// 	url: "ajax/datatable-sales.ajax.php",
// 	success: function(answer){
// 		console.log("answer",answer);

// 	}
// })

$('.tableSales').DataTable({
    "ajax": "ajax/datatable-sales.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true
});

/*=============================================
datatable in json
=============================================*/

$(".tableSales tbody").on("click", "button.addProduct", function () {

    var idProduct = $(this).attr("idProduct");
    $(this).removeClass("btn-primary addProduct");
    $(this).addClass("btn-default");
    var datas = new FormData();
    datas.append("idProduct", idProduct);
    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (answer) {
            var description = answer["description"];
            var stock = answer["stock"];
            var price = answer["sell_price"];

            /*=============================================
            alert when stock is 0 
            =============================================*/
            if (stock == 0) {
                swal({
                    title: 'ئەم کاڵایە نەماوە',
                    type: 'error',
                    confirmButtonText: 'باشە'
                });
                $("button[idProduct='" + idProduct + "']").addClass('btn-primary addProduct');
                return;
            }
            $(".newProduct").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Product description -->' +

                '<div class="col-xs-6" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' + idProduct + '"><i class="fa fa-times"></i></button></span>' +

                '<input type="text" class="form-control newProductDescription" idProduct="' + idProduct + '" name="addProductSale" value="' + description + '" readonly required>' +

                '</div>' +

                '</div>' +

                '<!-- Product quantity -->' +

                '<div class="col-xs-3">' +

                '<input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="1" stock="' + stock + '" newStock="' + Number(stock - 1) + '" required>' +

                '</div>' +

                '<!-- product price -->' +

                '<div class="col-xs-3 enterPrice" style="padding-left:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '<input type="text" class="form-control newProductPrice" realPrice="' + price + '" name="newProductPrice" value="' + price + '" readonly required>' +

                '</div>' +

                '</div>' +

                '</div>'
            )
            // adding total price
            addingTotalPrice();
            // discount for finalprice
            Discount();
            // listing all the products
            listproducts();
            // number format for prices
            $(".newProductPrice").number(true);
        }
    })
});

/*=============================================
WHEN TABLE LOADS EVERYTIME THAT NAVIGATE IN IT
=============================================*/

$(".tableSales").on("draw.dt", function () {
    if (localStorage.getItem("removeProduct") != null) {
        var listIdProduct = JSON.parse(localStorage.getItem("removeProduct"));
        for (var i = 0; i < listIdProduct.length; i++) {
            $("button.recoverButton[idProduct='" + listIdProduct[i]["idProduct"] + "']").removeClass('btn-default');
            $("button.recoverButton[idProduct='" + listIdProduct[i]["idProduct"] + "']").addClass('btn-primary addProduct');
        }
    }
})

/*=============================================
delete products when mistaking or regreting 
=============================================*/
var idRemoveProduct = [];
$(".saleForm").on("click", "button.removeProduct", function () {
    $(this).parent().parent().parent().parent().remove();
    var idProduct = $(this).attr("idProduct");


    /*=============================================
    storing the localStorage id of the product we want to delete 
    =============================================*/
    if (localStorage.getItem("removeProduct") == null) {
        idRemoveProduct = [];
    } else {
        idRemoveProduct.concat(localStorage.getItem("removeProduct"))
    }
    idRemoveProduct.push({
        "idProduct": idProduct
    });
    localStorage.setItem("removeProduct", JSON.stringify(idRemoveProduct));
    $("button.recoverButton[idProduct='" + idProduct + "']").removeClass('btn-default');
    $("button.recoverButton[idProduct='" + idProduct + "']").addClass('btn-primary addProduct');
    if ($(".newProduct").children().length == 0) {
        $("#newSaleTotal").val(0);
        $("#newSaleTotal").attr("totalSale", 0);
        $("#newDiscountPrice").val(0);
    } else {
        // adding total price
        addingTotalPrice();
        // discount for finalprice
        Discount()
        // listing all the products
        listproducts();
    }

});

/*=============================================
adding products from devices
=============================================*/

var numProduct = 0;

$(".btnAddProduct").click(function () {
    numProduct++;
    var datas = new FormData();
    datas.append("bringProducts", "ok");
    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (answer) {
            var price = answer["sell_price"];
            $(".newProduct").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Product description -->' +

                '<div class="col-xs-6" style="padding-right:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct><i class="fa fa-times"></i></button></span>' +

                '<select class="form-control newProductDescription" idProduct id="product' + numProduct + '" name="newProductDescription" required>' +

                '<option>Select product</option>' +

                '</select>' +

                '</div>' +

                '</div>' +

                '<!-- Product quantity -->' +

                '<div class="col-xs-3 enterQuantity">' +

                '<input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="0" stock newStock required>' +

                '</div>' +

                '<!-- Product price -->' +

                '<div class="col-xs-3 enterPrice" style="padding-left:0px">' +

                '<div class="input-group">' +

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '<input type="text" class="form-control newProductPrice" realPrice="' + price + '" name="newProductPrice" readonly required>' +

                '</div>' +

                '</div>' +

                '</div>'

            );




            answer.forEach(functionForEach);

            function functionForEach(item, index) {
                if (item.stock != 0) {
                    $("#product" + numProduct).append(
                        '<option idProduct="' + item.id + '" value="' + item.description + '">"' + item.description + '"</option>'
                    )
                }


            }
            // adding total price
            addingTotalPrice();
            // discount for finalprice
            Discount();
            // number format for prices
            $(".newProductPrice").number(true);

        }
    })
});

/*=============================================
select products from devices
=============================================*/


$(".saleForm").on("change", "select.newProductDescription", function () {
    var nameProduct = $(this).val();
    var newPriceProdcut = $(this).parent().parent().parent().children(".enterPrice").children().children(".newProductPrice");
    var datas = new FormData();
    var newQuantityProdcut = $(this).parent().parent().parent().children(".enterQuantity").children(".newProductQuantity");
    var datas = new FormData();
    datas.append("nameProduct", nameProduct);
    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (answer) {
            $(newQuantityProdcut).attr("stock", answer["stock"]);
            $(newQuantityProdcut).attr("newStock", Number(answer["stock"]) - 1);
            $(newPriceProdcut).val(answer["sell_price"]);
            $(newPriceProdcut).attr("realPrice", answer["sell_price"]);
        }
    })
    // listing all the products
    listproducts();
});

/*=============================================
modifying quantity products
=============================================*/

$(".saleForm").on("change", "input.newProductQuantity", function () {
    var price = $(this).parent().parent().children(".enterPrice").children().children(".newProductPrice");
    var finalPrice = $(this).val() * price.attr("realPrice");
    price.val(finalPrice);
    /*=============================================
    if stock is out of the range rest the quantity and the price
    =============================================*/
    var newStock = Number($(this).attr("stock")) - $(this).val();
    $(this).attr("newStock", newStock)
    if (Number($(this).val()) > Number($(this).attr("stock"))) {
        $(this).val(1);
        var finalPrice = $(this).val() * price.attr("realPrice");
        price.val(finalPrice);

        swal({
            title: 'عددی کاڵا کەمتر ماوە',
            text: ' تەنها ' + $(this).attr("stock") + ' دانە لەم کاڵایە ماوە ',
            type: 'error',
            confirmButtonText: 'باشە'
        });
    }
    // adding total price
    addingTotalPrice();

    // discount for finalprice
    Discount();
    // listing all the products
    listproducts();
})

/*=============================================
adding all the prices to finalPrice
=============================================*/

function addingTotalPrice() {
    var itemPrice = $(".newProductPrice");
    var arraySumPrice = [];
    for (var i = 0; i < itemPrice.length; i++) {
        arraySumPrice.push(Number($(itemPrice[i]).val()));
    }

    function addPricesArray(total, number) {
        return total + number;
    }
    var addTotalPrice = arraySumPrice.reduce(addPricesArray);
    $("#newSaleTotal").val(addTotalPrice);
    $("#newSaleTotal").attr("totalSale", addTotalPrice);
    $("#saleTotal").val(addTotalPrice);
}

/*=============================================
discount to finalPrice
=============================================*/

function Discount() {

    var discount = $("#newDiscountSale").val();
    var totalPrice = $("#newSaleTotal").attr("totalSale");
    var discountPrice = Number(totalPrice * discount / 100);
    var totalWithDiscount = Number(totalPrice) - Number(discountPrice);
    $("#newSaleTotal").val(totalWithDiscount);
    $("#newDiscountPrice").val(discountPrice);
    $("#newNetPrice").val(totalPrice);
    $("#saleTotal").val(totalWithDiscount);
}

$("#newDiscountSale").change(function () {
    Discount();
});

/*=============================================
number format for totalPrice
=============================================*/

$("#newSaleTotal").number(true);

/*=============================================
SELECT PAYMENT METHOD
=============================================*/

$("#newPaymentMethod").change(function () {

    var method = $(this).val();

    if (method == "cash") {

        $(this).parent().parent().removeClass("col-xs-6");

        $(this).parent().parent().addClass("col-xs-4");

        $(this).parent().parent().parent().children(".paymentMethodBoxes").html(

            '<br>' +
            '<br>' +

            '<table class="table">' +

            '<thead style="font-family: NRT;">' +

            '<th>پارەی دراو</th>' +
            '<th>باقی</th>' +

            '</thead>' +


            '<tbody>' +

            '<tr>' +

            '<td style="width: 50%">' +

            '<div class="col-xs">' +

            '<div class="input-group">' +

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

            '<input type="text" class="form-control" id="newCashValue" placeholder="000000" >' +

            '</div>' +

            '</div>' +
            '</td>' +

            '<td style="width: 50%">' +

            '<div class="col-xs" id="getCashChange" style="padding-left:0px">' +

            '<div class="input-group">' +

            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

            '<input type="text" class="form-control" id="newCashChange" placeholder="000000" readonly >' +

            '</div>' +

            '</div>' +

            '</td>' +

            '</tr>' +

            '</tbody>' +

            '</table>'

        )

        // Adding format to the price

        $('#newCashValue').number(true);
        $('#newCashChange').number(true);


    } else {

        $(this).parent().parent().removeClass('col-xs-4');

        $(this).parent().parent().addClass('col-xs-6');

        $(this).parent().parent().parent().children('.paymentMethodBoxes').html(

            '<div class="col-xs-6" style="padding-left:0px">' +

            '<div class="input-group">' +

            '<input type="hidden" min="0" class="form-control" id="newTransactionCode" placeholder="Transaction code" >' +

            '</div>' +

            '</div>')

    }



})

/*=============================================
CASH CHANGE
=============================================*/

$(".saleForm").on("change", "input#newCashValue", function () {
    var cashValue = $(this).val();
    var change = Number(cashValue) - Number($("#newSaleTotal").val());
    $("#newCashChange").val(change);
})

/*=============================================
list all the product
=============================================*/
function listproducts() {
    var listproduct = [];

    var description = $(".newProductDescription");
    var quantity = $(".newProductQuantity");
    var price = $(".newProductPrice");
    // var totalPrice = $(".newProductQuantity").val();
    for (var i = 0; i < description.length; i++) {
        listproduct.push({
            "id": $(description[i]).attr("idProduct"),
            "description": $(description[i]).val(),
            "stock": $(quantity[i]).attr("newStock"),
            "quantity": $(quantity[i]).val(),
            "price": $(price[i]).attr("realPrice"),
            "totalprice": $(price[i]).val()
        });
    }
    console.log(listproduct);
    $("#productsList").val(JSON.stringify(listproduct));
}
/*=============================================
Edit SALE
=============================================*/

$(".tables").on("click", ".btnEditSale", function () {

    var idSale = $(this).attr("idSale");

    window.location = "index.php?route=edit-sales&idSale=" + idSale;


})


/*=============================================
DELETE SALE
=============================================*/
$(".tables").on("click", ".btnDeleteSale", function () {

    var idSale = $(this).attr("idSale");

    swal({
		title: 'دڵنیای کە دەتەوێت ئەم فرۆشتنە بسریتەوە ؟',
		text: "ئەگەر ناتەوێت پەشیمان بوونەوە داگرە",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'پەشیمان بوونەوە',
        confirmButtonText: 'بەڵی ، بیسرەوە'
    }).then(function (result) {
        if (result.value) {

            window.location = "index.php?route=manage-sales&idSale=" + idSale;
        }

    })

})

/*=============================================
DELETE SALE
=============================================*/
$(".tables").on("click", ".btnPrintBill", function () {
    var codeSale = $(this).attr("codeSale");
    window.open("extensions/tcpdf/pdf/bill.php?codeSale=" + codeSale);

})

/*=================================
=       Date range as a button for sale range           =
=================================*/
$('#daterange-btn').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()
    },
    function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');
        var captureRange = $('#daterange-btn span').html();
        localStorage.setItem("captureRange", captureRange);

        window.location = "index.php?route=manage-sales&startDate="+ startDate +"&endDate="+endDate;
    }
)

/*=================================
    canceling Date rangefor sale range
=================================*/

$(".daterangepicker.opensleft .ranges .range_inputs .cancelBtn").on("click", function(){
    localStorage.removeItem("captureRange");
    localStorage.clear();
    window.location = "manage-sales";
})

$(".daterangepicker.opensleft .ranges li").on("click", function(){
    var todayButton = $(this).attr("data-range-key");
    if(todayButton == "Today"){

		var d = new Date();
		
		var day = d.getDate();
		var month= d.getMonth()+1;
		var year = d.getFullYear();
        if(month < 10 && day < 10){

			var startDate = year+"-0"+month+"-0"+day;
			var endDate = year+"-0"+month+"-0"+day;

		}
        
        else if(day < 10){

			var startDate = year+"-"+month+"-0"+day;
			var endDate = year+"-"+month+"-0"+day;

		}
        else if(month < 10){

			var startDate = year+"-0"+month+"-"+day;
			var endDate = year+"-0"+month+"-"+day;

		} else{
			var startDate = year+"-"+month+"-"+day;
	    	var endDate = year+"-"+month+"-"+day;
		}
        console.log(startDate);
        console.log(endDate);
        localStorage.setItem("captureRange", "Today");
    	window.location = "index.php?route=manage-sales&startDate="+startDate+"&endDate="+endDate;
    }
})