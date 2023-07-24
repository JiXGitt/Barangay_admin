<div id="cashInputField">
    <label class="label has-text-black">Cash Rendered</label>

    <p id="cashInput" class="control is-expanded has-icons-left">

        <input class="input is-rounded" name="cash_value" id='cashValue' type="number" placeholder=" Enter your cash ">
        <span class="icon is-left">
            <i class="fa-solidfa-coins"></i>
        </span>

    </p>
    <p id="cash-input-help-text" class="help is-danger" style="display:none">Cash is lower than the payable amount</p>
    <p id="cashrequired-input-help-text" class="help is-danger" style="display:none">This is required</p>
    <p id="fillup-input-help-text" class="help is-danger" style="display:none">Please follow the information above</p>
</div>

<div id="calculator" class="box shadow-box2 background-light m-5">

    <p class="control">
        <button id="" class="delete button is-danger
                    is-outlined is-responsive" style="background-color: rgb(236, 79, 79);">

        </button>
    </p>

    <div class="columns has-text-centered is-centered is-mobile">
        <input type="button" class="calcData column button is-2 has-text-dark" value="C"></input>
        <input type="button" class="calcData column button is-2 has-text-dark" value="del">
        <input type="button" class="calcData column button is-2  has-text-dark" value="/">
        <input type="button" class="calcData column button is-2 has-text-dark" value="x">
    </div>
    <div class="columns has-text-centered is-centered is-mobile">
        <input type="button" class="calcData column button is-2 has-text-dark" value="7">
        <input type="button" class="calcData column button is-2 has-text-dark" value="8">
        <input type="button" class="calcData column button is-2  has-text-dark" value="9">
        <input type="button" class="calcData column button is-2 has-text-dark" value="-">
    </div>
    <div class="columns has-text-centered is-centered is-mobile">
        <input type="button" class="calcData column button is-2 has-text-dark" value="4">
        <input type="button" class="calcData column button is-2 has-text-dark" value="5">
        <input type="button" class="calcData column button is-2  has-text-dark a" value="6">
        <input type="button" class="calcData column button is-2 has-text-dark" value="+">
    </div>
    <div class="columns has-text-centered is-centered is-mobile">
        <input type="button" class="calcData column button is-2 has-text-dark" value="1">
        <input type="button" class="calcData column button is-2 has-text-dark" value="2">
        <input type="button" class="calcData column button is-2  has-text-dark" value="3">
        <input type="button" class="calcData column button is-2 has-text-dark" value="=">
    </div>

    <div class="columns has-text-centered is-centered is-mobile">
        <input type="button" class="calcData column button is-6 has-text-dark" value="0">
        <input type="button" class="calcData column button is-2 has-text-dark" value=".">
    </div>

    <!-- calculator buttons -->
    <div class="field buttons is-grouped is-grouped-centered">
        <p class="control">
            <button id="calculate" class="button is-success
                is-normal  is-responsive">
                <span class="icon">
                    <i class="fa-solid
                            fa-calculator"></i>
                </span>
                <span>CALCULATE</span>
            </button>
        </p>
        <p class="control">
            <button id="change" class="button is-success
                    is-outlined is-normal is-responsive">
                <span class="icon">
                    <i class="fa-solid
                            fa-calculator"></i>
                </span>
                <span>CHANGE</span>
            </button>
        </p>
        <p class="control">
            <button type="submit" name="new" class=" button is-primary
                    is-normal is-responsive">
                <span class="icon">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <span>NEW</span>
            </button>
        </p>

        <!-- employee list path -->
        <p class="control">
            <a  href="<?= SALES_PATH['list'] ?>" class=" button is-primary
                    is-normal is-responsive">
                <span>PREVIEW LIST</span>
            </a>
        </p>

    </div>

</div>