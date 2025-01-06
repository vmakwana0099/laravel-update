<tr id="filter_availibity">
    <td>
        <div class="c-radio-btn d-flex">
            <label class="custom-radio">
                <input type="checkbox"> 
                <span class="checkmark"></span>
               {{$suggdata["domainname"]}}
            </label>
        </div>
    </td>
    <td class="m-hide"><span class="status" id="var_available_<?= $P ?>"></span></td>
    <td class="text-center m-hide"><span class="price"><i class="rupees_icon" id="var_price_<?= $P ?>">&#8377;</i> {{$suggdata["pricing"]}}</span></td>

    @if($suggdata["status"] == 'available')
    <td class="text-right" id="cart_add_<?= $P ?>"><a href="#" class="btn addcart_btn" title="Add to Cart">Add to Cart</a></td>
    @else
    <td class="text-right" id="transfer_<?= $P ?>" style="display: none;">
        <a href="#" class="btn inquiry_btn" title="Inquiry"><i class="info_icon"></i><span class="">Inquiry</span></a>
        <a href="#" class="btn addcart_btn" title="Transfer">Transfer</a>
    </td>
    @endif
</tr>