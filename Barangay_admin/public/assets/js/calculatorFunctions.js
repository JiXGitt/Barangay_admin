$(function () {
  // show the calculator
  var delay = 3000;
  var calcID = $("#calc");
  $(calcID).on("click", function (event) {
    event.preventDefault();
    if ($("#quantityOfOrder").val() === "") {
      $(".quantityOfOrder-input-help-text").show();

      $("#quantityOfOrder").addClass("is-danger");
      $("#quantityOfOrder").removeClass("is-success");
      $("#quantityOfOrder").focus();
    }
    if ($("#foodName").val() === "") {
      $("#foodName-input-help-text").show();

      $("#foodName").addClass("is-danger");
      $("#foodName").removeClass("is-success");
      $("#foodName").focus();
    }
    if ($("#foodPrice").val() === "") {
      $("#foodPrice-input-help-text").show();

      $("#foodPrice").addClass("is-danger");
      $("#foodPrice").removeClass("is-success");
      $("#foodPrice").focus();
    }
    if (
      $("#quantityOfOrder").val() !== "" &&
      $("#foodName").val() !== "" &&
      $("#foodPrice").val() !== ""
    ) {
      $(".quantityOfOrder-input-help-text").hide();
      $("#foodName-input-help-text").hide();
      $("#foodPrice-input-help-text").hide();

      $("#quantityOfOrder").removeClass("is-danger");
      $("#quantityOfOrder").addClass("is-success");
      // $('#quantityOfOrder').focus();

      $("#foodName").removeClass("is-danger");
      $("#foodName").addClass("is-success");
      // $('#foodName').focus();

      $("#foodPrice").removeClass("is-danger");
      $("#foodPrice").addClass("is-success");
      // $('#foodPrice').focus();

      var setTimeoutForOpenCalcButton = setTimeout(function () {
        $("#calculator").show(delay);
        // Go up to the calculator
        $("html, body").animate(
          {
            scrollTop: $("#calculator").offset().top,
          },
          4000
        );
      }, 500);

      this.disabled = true;
    }
  });

  // hide the calculator
  var $closeCalc = $(".delete");
  $closeCalc.on("click", function (event) {
    event.preventDefault();
    $("#calculator").hide(1000);

    // Enable the open calculator button
    $("#calc").prop("disabled", false);
  });

  // bind calculator buttons to input field
  // var $cashValue = $("#cashValue");
  // var $calcData = $(".calcData");
  var $calcData = $(".calcData");
  $calcData.on({
    click: function (event) {
      $(this).css({
        "background-color": "hsl(64, 42%, 67%)",
        tranform: "scale(1.2)",
        transition: "all 0.5s ease-in-out",
      });

      var $cashValue = $("#cashValue");

      $cashValue.val($cashValue.val() + $(this).val());
    },

    mouseleave: function (event) {
      event.preventDefault();
      $(this).css("background-color", "white");
    },
  });

  //   calculate the discounts
  $("#calculate").on({
    click: function (e) {
      e.preventDefault();

      let $amount = $("#foodPrice").val();
      let $quantity = $("#quantityOfOrder").val();
      let $discount = 0.25;

      let $total = $amount * $quantity;

      let $discountAmount = $total * $discount;
      let $discountedAmount = $total - $discountAmount;
      let $discountedGiven = $discountAmount;
      let $totalDiscountedGiven = $discountedGiven * $quantity;
      let $totalDiscountedAmount = $discountedAmount * $quantity;

      let $discountAmountRounded = $discountAmount.toFixed(2);
      let $discountedAmountRounded = $discountedAmount.toFixed(2);

      $("#totalQuantity").val($total.toFixed(2));
      $("#discountAmount").val($discountAmountRounded);
      $("#discountedAmount").val($discountedAmountRounded);
      $("#totalDiscountedAmount").val($totalDiscountedAmount.toFixed(2));
      $("#totalDiscountedGiven").val($totalDiscountedGiven.toFixed(2));

      // This will help to save the values to the session storage
      sessionStorage.setItem("totalQuantity", $total);
      sessionStorage.setItem("discountAmount", $discountAmountRounded);
      sessionStorage.setItem("discountedAmount", $discountedAmountRounded);
      sessionStorage.setItem("totalDiscountedAmount", $totalDiscountedAmount);
      sessionStorage.setItem("totalDiscountedGiven", $totalDiscountedGiven);
    },
  });

  // validate cash input value
  $("#cashValue").on({
    keyup: function () {
      var $cashValue = $(this).val();
      var $discountedAmount = $("#discountedAmount").val();

      if ($cashValue < $discountedAmount) {
        $("#cashValue").addClass("is-danger");
        $("#cashValue").on({
          focus: function () {
            $("#cashValue").toggleClass("is-danger");
          },
        });
        $("#cash-input-help-text").show();
      } else {
        $("#cashValue").removeClass("is-danger");
        $("#cash-input-help-text").hide();
      }
    },
  });

  //   calculate the change
  $("#change").on({
    click: function (e) {
      e.preventDefault();
      if (
        $("#totalDiscountedGiven").val() == "" &&
        $("#totalDiscountedAmount").val() == "" &&
        $("#totalQuantity").val() == ""
      ) {
        $("#totalDiscountedGiven-input-help-text").show();
        $("#totalDiscountedAmount-input-help-text").show();
        $("#totalquantity-input-help-text").show();
        $("#discountAmount-input-help-text").show();
        $("#discountedAmount-input-help-text").show();

        $("#totalDiscountedGiven").addClass("is-danger");
        $("#totalDiscountedAmount").addClass("is-danger");
        $("#totalQuantity").addClass("is-danger");
        $("#discountAmount").addClass("is-danger");
        $("#discountedAmount").addClass("is-danger");
        $("#cashValue").addClass("is-danger");
        $("#changeValue").addClass("is-danger");

        $("#totalDiscountedGiven").focus();
      } else {
        $("#totalDiscountedAmount").on("change", function () {
          $("#totalDiscountedGiven-input-help-text").hide();
          $("#totalDiscountedAmount-input-help-text").hide();
          $("#totalquantity-input-help-text").hide();
          $("#discountAmount-input-help-text").hide();
          $("#discountedAmount-input-help-text").hide();

          $("#totalDiscountedGiven").removeClass("is-danger");
          $("#totalDiscountedAmount").removeClass("is-danger");
          $("#totalQuantity").removeClass("is-danger");
          $("#discountAmount").removeClass("is-danger");
          $("#discountedAmount").removeClass("is-danger");

          $("#totalDiscountedGiven").addClass("is-success");
          $("#totalDiscountedAmount").addClass("is-success");
          $("#totalQuantity").addClass("is-success");
          $("#discountAmount").addClass("is-success");
          $("#discountedAmount").addClass("is-success");

          $("#totalDiscountedGiven").focus();
          $("#totalDiscountedGiven").focus();
          $("#totalQuantity").focus();
          $("#discountAmount").focus();
          $("#discountedAmount").focus();
        });
      }

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
      $("#cashrequired-input-help-text").hide();
      $("#cashValue").removeClass("is-danger");
      $("#cashValue").addClass("is-success");
    },
  });

  $('.reset-btn').on({
    click: function(e) {
      e.preventDefault();

      // remove the values from the session storage
      let price = sessionStorage.removeItem("price");
      let foodname = sessionStorage.removeItem("foodName");

      $("#foodName").val(foodname);
      $("#foodPrice").val(price);
    }
  })
});
