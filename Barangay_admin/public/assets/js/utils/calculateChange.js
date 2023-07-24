export function calculateChange() {
  $(document).ready(function () {
    var $cashValue = $("#cashValue").val();
    var $totalDiscountedGiven = $("#totalDiscountedGiven").val();
    var $change = $cashValue - $totalDiscountedGiven;

    if ($totalDiscountedGiven == "") {
      $("#fillup-input-help-text").show();
      $("#cashValue").addClass("is-danger");
      $("#totalDiscountedGiven").focus();
    } else if ($("#cashValue").val() == "") {
      $("#cashrequired-input-help-text").show();
      $("#cashValue").addClass("is-danger");
      $("#cash-input-help-text").hide();
      $("#cashValue").focus();
    } else if ($change < 0) {
      $("#changeValue").val("0.00");
      $("#changeValue").addClass("is-danger");
      $("#changeValue").focus();
      $("#cash-input-help-text").show();
      $("#fillup-input-help-text").hide();

      $("#cashValue").addClass("is-danger");
      $("#cashValue").focus();
    } else if ($change >= 0) {
      $("#changeValue").val($change);
      $("#changeValue").removeClass("is-danger");
      $("#changeValue").addClass("is-success");
      $("#changeValue").focus();

      $("#cash-input-help-text").hide();
      $("#fillup-input-help-text").hide();
    }
  });
}
