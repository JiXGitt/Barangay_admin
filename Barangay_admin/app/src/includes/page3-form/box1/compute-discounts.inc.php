<div class="field is-horizontal">
    <div class="field-body">
        <div class="field">
            <label class="label is-capitalized">discount Amount</label>
            <p class="control has-icons-left">

                <input id="discountAmount" name="discount_amount" class="input is-rounded" type="number" placeholder="0.00" readonly>
                <span class="icon is-left">
                    <i class="fa-solid fa-arrow-down-short-wide"></i>
                </span>

            </p>
            <p id="discountAmount-input-help-text" class="help is-danger" style="display:none">This is required. Please click Calculate button first!</p>
        </div>

        <div class="field">
            <label class="label is-capitalized" for="discounted_amount">discounted Amount</label>
            <p class="control has-icons-left">
                <input id="discountedAmount" name="discounted_amount" class="input is-rounded" type="number" placeholder="0.00" readonly>
                <span class="icon is-left">
                    <i class="fa-solid fa-tag"></i>
                </span>
            </p>
            <p id="discountedAmount-input-help-text" class="help is-danger" style="display:none">This is required. Please click Calculate button first!</p>
        </div>
    </div>
</div>

<p class="control">
    <button class="reset-btn button is-danger is-normal is-responsive ">
        <span class="icon">
            <i class="fa-solid fa-minus"></i>
        </span>
        <span>RESET</span>
    </button>
</p>