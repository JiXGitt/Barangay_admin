<h3 class="box-header"> Order Detail </h3>
<div class="field is-horizontal">
    <div class="field-body">
        <div class="field">
            <p class="control is-expanded has-icons-left">
                <input id="foodName" class="input is-rounded" type="text" placeholder="food name" name="item_name" readonly>
                <span class="icon is-left">
                    <i class="fa-solid fa-bowl-food"></i>
                </span>
            </p>
            <p id="foodName-input-help-text" class="help is-danger " style="display:none">This is required. Follow the reminder!</p>
        </div>

        <div class="field">
            <p class="control is-expanded has-icons-left">
                <input id="quantityOfOrder" name="quantity" class="input is-rounded" type="number" placeholder="quantity">
                <span class="icon is-left">
                    <i class="fa-solid fa-hashtag"></i>
                </span>
            </p>
            <p class="help is-danger quantityOfOrder-input-help-text" style="display:none">This is required</p>
        </div>

        <div class="field">
            <p class="control is-expanded has-icons-left">
                <input id="foodPrice" name="item_price" class="input is-rounded" type="number" placeholder="price" readonly>
                <span class="icon is-left">
                    <i class="fa-solid fa-peso-sign"></i>
                </span>
            </p>
            <p id="foodPrice-input-help-text" class="help is-danger" style="display:none">This is required. Follow the reminder!</p>
        </div>
    </div>
</div>