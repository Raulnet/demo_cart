/**
 * Created by raulnet on 02/08/17.
 */
$(function () {
    /**
     * @param cart
     */
    renderCart = function (cart) {
        var sumPriceOrder = parseFloat(cart.order.sum_price);
        var sumProduct = parseInt(cart.order.sum_product);
        var $sumProduct = $('#sum_product');
        $sumProduct.html("("+cart.order.sum_product +")");
        if(sumProduct > 0){
            $sumProduct.show();
            $('#cart_action').show();
        } else {
            $sumProduct.hide();
            $('#cart_action').hide();
        }
        $('#order').html(sumPriceOrder.toFixed(2)+"€");
        var products = cart.products;
        var template = "";
        $.each(products, function (index, product) {
            var row = "<tr><td>"+product.title+"</td><td>"+product.sum_product +"</td><td>"+parseFloat(product.sum_price).toFixed(2) +"€</td><td><button data-product_id='"+product.product_id+"' class='btn btn-xs btn-default addProduct'>+</button><button data-product_id='"+product.product_id+"' class='btn btn-xs btn-default removeProduct'>-</button></td></tr>";
            template += row;
        });
        $('#cart tbody').html(template);
    };

    /**
     * @param url
     * @param productId
     */
    updateCart = function(url, productId){
        $.ajax({
            url: url,
            method: "POST",
            data: {
                product_id : productId
            },
            success: function (response) {
                response = JSON.parse(response);
                renderCart(response);
            }
        });
    };
    sendOrder = function(url){
        $.ajax({
            url: url,
            method: "POST",
            data: {},
            success: function (response) {
                $('#order_Modal .modal-body').html(response);
                $('#order_Modal').modal('show');
            }
        });
    };
    getDetailOrder = function(orderId){
        $.ajax({
            url: '/getDetailOrder',
            method: "POST",
            data: {"order_id": orderId },
            success: function (response) {
                $('#order_Modal .modal-body').html(response);
                $('#order_Modal').modal('show');
            }
        });
    };

    $(".container").on('click', '.addProduct', function (e) {
        e.preventDefault();
        updateCart("/addProduct", $(this).data('product_id'));
    });

    $(".container").on('click', '.removeProduct', function (e) {
        e.preventDefault();
        updateCart("/removeProduct", $(this).data('product_id'));
    });

    $(".container").on('click', '#resetCart', function (e) {
        e.preventDefault();
        updateCart("/resetCart", null);
    });
    $(".container").on('click', '#sendOrder', function (e) {
        e.preventDefault();
        sendOrder("/sendOrder");
        updateCart('/initOrder', null);
    });
    // PAGE COMMAND
    $('.getDetailOrder').on('click', function (e) {
        e.preventDefault();
        getDetailOrder($(this).data('order_id'));
    })
});