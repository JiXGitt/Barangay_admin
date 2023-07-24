  <div class="row row-cols-2 accordion-body g-4">
      <!-- Other Income Column -->
      <div class="col-12">
          <p class="display-6"> Other Income </p>

          <div class="row md-4">
              <label for="OtherIncome1" class="col-md-6 col-form-label">
                  Rate / Hour
              </label>
              <div class="col-sm-4">
                  <input type="number" 
                  class="form-control" id="OtherIncome1" name="other_income_rate_per_hr" 
                  value="<?= $emp['other_income_rate_per_hr'] ?? 0 ?>">
              </div>
          </div>

          <br>

          <div class="row md-4">
              <label for="OtherIncome2" class="col-md-6 col-form-label">
                  No. of Hours / Cut Off
              </label>

              <div class="col-sm-4">
                  <input type="number" class="form-control" id="OtherIncome2" name="other_income_num_of_hrs_per_cutOff" value="<?= $emp['other_income_num_of_hrs_per_cutOff'] ?? 0 ?>">
              </div>
          </div>

          <br>

          <div class="row md-4">
              <label for="OtherIncome3" class="col-md-6 col-form-label">
                  Total Other Income Pay
              </label>

              <div class="col-sm-4">
                  <input type="number" class="form-control" id="OtherIncome3" name="total_other_income_pay" value="<?= $emp['total_other_income_pay'] ?? 0?>" readonly>
              </div>
          </div>
      </div>
  </div>