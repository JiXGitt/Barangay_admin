$(document).ready(function () {
    // get the item from the session storage
    let price = sessionStorage.getItem("price");
    let foodName = sessionStorage.getItem("foodName");

    $("#foodName").val(foodName);
    $("#foodPrice").val(price);
});