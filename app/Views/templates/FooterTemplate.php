<footer>
    <nav class="bg-light"></nav>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

<script type="text/javascript">
    let baseUrl = '<?=base_url()?>';
    Cookies.remove('withCoupon');
    Cookies.set('withCoupon',JSON.stringify({active:false}));
    set_count();

    $('.quantity_actions .addmore').click(function(){
        let parent = $(this).closest('tr');
        let itemid = parseInt($(this).attr('data-id'));
        parent.find('.delete').hide();
        parent.find('.deduct').show();
        add_cart(itemid);

        let percent = JSON.parse(Cookies.get('withCoupon')).active ? JSON.parse(Cookies.get('withCoupon')).percent : 0;
        refresh_data(parent,itemid,'add',percent);
    });

    $('.quantity_actions .deduct').click(function(){
        let parent = $(this).closest('tr');
        let itemid = parseInt($(this).attr('data-id'));
        let quantity = parseInt(parent.find('.quantity').text());
        console.log(quantity);
        if((quantity - 1) <= 1){
            parent.find('.delete').show();
            parent.find('.deduct').hide();
        }
        remove_cart(itemid);

        let percent = JSON.parse(Cookies.get('withCoupon')).active ? JSON.parse(Cookies.get('withCoupon')).percent : 0;
        refresh_data(parent,itemid,'deduct',percent);
    });

    $('.quantity_actions .delete').click(function(){
        let parent = $(this).closest('tr');
        let itemid = parseInt($(this).attr('data-id'));
        remove_cart(itemid);

        let percent = JSON.parse(Cookies.get('withCoupon')).active ? JSON.parse(Cookies.get('withCoupon')).percent : 0;
        refresh_data(parent,itemid,'delete',percent);
    });

    $('#apply_voucher').click(function(){
        let code = $('.coupon_code').val();
        if(code != ''){
            $.ajax({
                async: true,
                type: 'POST',
                url: baseUrl+'/Checkout/validate_coupon',
                data: {code:code},
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if(data){
                        Cookies.remove('withCoupon');
                        Cookies.set('withCoupon',JSON.stringify({active:true,percent:data[0].percent,cid:data[0].id})); 
                        refresh_data('','','coupon',data[0].percent);
                    }else{
                        $('.invalid_coupon').slideDown();
                        setTimeout(() => {
                            $('.invalid_coupon').slideUp();
                        },3000)
                    }
                }
            });
        }
    });

    $('.save_order').click(function(){
        $.ajax({
            async: true,
            type: 'POST',
            url: baseUrl+'/Checkout/save_orders',
            // data: {code:code},
            cache: false,
            dataType: 'json',
            success: function(data) {
                Cookies.remove('withCoupon');
                Cookies.remove('current_orders');
                Cookies.set('withCoupon',JSON.stringify({active:false}));
                window.location.href = baseUrl+'/Summary/'+data;
            }
        });
    })

    function add_cart(itemId){
        let orders = Cookies.get("current_orders");
        if(!orders){
            Cookies.set("current_orders",JSON.stringify([itemId]));
        }else{
            let neworders = JSON.parse(orders);
            neworders.push(itemId);
            Cookies.remove('current_orders');
            Cookies.set("current_orders",JSON.stringify(neworders));
        }
        set_count();
    }

    function remove_cart(itemId){
        let orders = Cookies.get("current_orders");
        let neworders = JSON.parse(orders);
        if($.inArray(itemId,neworders) !== -1){
            neworders.splice( $.inArray(itemId,neworders), 1 );
            Cookies.remove('current_orders');
            Cookies.set("current_orders",JSON.stringify(neworders));
        }
    }

    function set_count(){
        let orders = Cookies.get("current_orders");
        if(!orders){
            $('.order_count').text('');
        }else{
            let neworders = JSON.parse(orders);
            $('.order_count').text(neworders.length);
        }
    }

    function refresh_data(parent,itemid,type,perc){
        let data = {
            orders:Cookies.get("current_orders"),
            percent: perc || 0
            };
        $.ajax({
            async: true,
            type: 'POST',
            url: baseUrl+'/Checkout/change_quantity',
            data: data,
            cache: false,
            dataType: 'json',
            success: function(data) {
                if(type != 'delete'){
                    if(type != 'coupon' && type != 'resetcoupon'){
                        parent.find('.quantity').text(data.orders[itemid].quantity);
                        parent.find('.item_price').text('PHP '+data.orders[itemid].price);
                    }
                    $('.discount_area').fadeOut();
                    if(data.discount){
                        $('.coupon_code').prop('disabled',true);
                        $('#apply_voucher').prop('disabled',true);
                        $('.discounttotal').text('PHP '+data.discount);
                        $('.discount_area').fadeIn();
                    }
                }else{
                    parent.remove();
                }
                $('.pretotal').text('PHP '+data.pretotal);
                $('.taxtotal').text('PHP '+data.tax);
                $('.grandtotal').text('PHP '+data.grandtotal);
                set_count();
            }
        });
    }
</script>
</body>

</html>