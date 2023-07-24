  <!-- Second box -->
  <h3 class="box-header"> Order Summary </h3>
  <div class="field is-horizontal">
      <div class="field-body">

      <!-- MAKE THIS DRY APPROACH USING PHP IF THERE IS ENOUGH -->

          <div class="field">
              <label class="label is-capitalized">total quantity</label>
              <p class="control is-expanded has-icons-left">
                  <input id="totalQuantity" name="totalQuantity" class="input is-rounded" type="number" placeholder="0.00" readonly>
                  <span class="icon is-left">
                      <i class="fa-solid fa-coins"></i>
                  </span>
              </p>
              <p id="totalquantity-input-help-text" class="help is-danger" style="display:none">This is required. Please click Calculate button first!</p>
          </div>

          <div class="field">
                <label class="label is-capitalized">total discount given</label>
                <p class="control is-expanded has-icons-left">
                    <input id="totalDiscountedGiven" name="totalDiscountedGiven" class="input is-rounded" type="number" placeholder="0.00" readonly>

                    <span class="icon is-left">
                        <i class="fa-solidfa-coins"></i>
                    </span>
                    
                </p>
              <p id="totalDiscountedGiven-input-help-text" class="help is-danger" style="display:none">This is required. Please click Calculate button first!</p>
          </div>
      </div>
  </div>
  <div class="field">
      <label class="label is-capitalized">total discounted amount</label>
      <p class="control is-expanded has-icons-left">
          <input id="totalDiscountedAmount" name="totalDiscountedAmount" class="input is-rounded" type="number" placeholder="0.00" readonly>
          <span class="icon is-left">
              <i class="fa-solid fa-equals"></i>
          </span>
      </p>
      <p id="totalDiscountedAmount-input-help-text" class="help is-danger" style="display:none">This is required. Please click Calculate button first!</p>
  </div>