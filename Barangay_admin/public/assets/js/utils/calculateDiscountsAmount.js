export function calculateDiscounts() {
  $(document).ready(function () {
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
  });
}
