<div class="checkout_container">
    <?php if(!$empty): ?>
    <div class="page_title">Selected Orders</div>
    <div class="order_list">
        <table>
            <tbody>
                <?php foreach($orders as $key => $item): ?>
                <tr>
                    <td>
                        <div class="quantity_actions">
                            <i data-id ="<?=$key?>" class="delete fa fa-trash-alt <?=$item['quantity'] > 1 ? 'hidden': '' ?>"></i>
                            <i data-id ="<?=$key?>" class="deduct fa fa-minus <?=$item['quantity'] <= 1 ? 'hidden': '' ?>"></i>
                            <span class="quantity"><?=$item['quantity']?></span>
                            <i data-id ="<?=$key?>" class="addmore fa fa-plus"></i>
                        </div>
                    </td>
                    <td><?=$item['name']?></td>
                    <td class="item_price">PHP <?=$item['price']?></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <td></td>
                    <td class="text-end table_sub_tl">Pre Total</td>
                    <td class="pretotal">PHP <?=$pretotal?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end table_sub_tl">Tax</td>
                    <td class="taxtotal">PHP <?=$tax?></td>
                </tr>
                <tr class="discount_area <?=isset($discount) ? 'active' : ''?>">
                    <td></td>
                    <td class="text-end table_sub_tl">Coupon Discount</td>
                    <td class="discounttotal">PHP <?=isset($discount) ? $discount : ''?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end table_main_tl">Grand Total</td>
                    <td class="grandtotal">PHP <?=$grandtotal?></td>
                </tr>
            </tbody>
        </table>

        <div class="voucher_area">
            <div class="input-group mb-3">
                <input type="text" class="form-control coupon_code" placeholder="Apply Voucher Here" aria-label="Recipient's username" aria-describedby="apply_voucher">
                <button class="btn btn-outline-secondary" type="button" id="apply_voucher">Apply Voucher</button>
            </div>
            <div class="alert alert-danger text-center invalid_coupon" role="alert">
                Invalid Coupon Code!
            </div>
        </div>

        <button class="save_order">Save Order</button>
    </div>
    <?php else: ?>
    <h1>Please Select Items from our Menu.</h1>
    <?php endif; ?> 
</div>