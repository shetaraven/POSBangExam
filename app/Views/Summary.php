<div class="summary">
    <div class="page_title">Order Summary</div>
    <div class="page_subtitle">Order Date: <?=$details['date']?></div>
    <div class="order_list">
        <table>
            <tbody>
                <?php foreach($orders as $key => $item): ?>
                <tr>
                    <td>
                        <div class="quantity_actions">
                            <span class="quantity"><?=$item->quantity?>X</span>
                        </div>
                    </td>
                    <td><?=$item->name?></td>
                    <td class="item_price">PHP <?=$item->price?></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <td></td>
                    <td class="text-end table_sub_tl">Pre Total</td>
                    <td class="pretotal">PHP <?=$details['pre_total']?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end table_sub_tl">Tax</td>
                    <td class="taxtotal">PHP <?=$details['tax_total']?></td>
                </tr>
                <tr class="discount_area <?=$details['discount'] != 0 ? 'active' : ''?>">
                    <td></td>
                    <td class="text-end table_sub_tl">Coupon Discount</td>
                    <td class="discounttotal">PHP <?=isset($details['discount']) ? $details['discount'] : ''?></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end table_main_tl">Grand Total</td>
                    <td class="grandtotal">PHP <?=$details['grand_total']?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>