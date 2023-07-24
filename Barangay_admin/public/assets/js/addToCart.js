// $(document).ready(function () {
//   // select multiple add to cart button
//   $(".addToCartBtn").on({
//     click: function (e) {
//       e.preventDefault();
//       const price = $(this)
//         .parent()
//         .find(".grid-footer")
//         .find("span[name='PriceTag']")
//         .text();
//       const foodName = $(this)
//         .parent()
//         .find(".grid-footer")
//         .find("span[name='foodName']")
//         .text();
//       const foodNameTrim = foodName.trim(); //remove white space from the name
//       const image = $(this).parent().find("figure").find("img").attr("src");
//       const foodItem = {
//         foodName: foodNameTrim,
//         price: price,
//         image: image,
//       };

//       // check if the food item is already in the cart
//       if (localStorage.getItem("foodItem") === null) {
//         // if the cart is empty, create an array and push the food item
//         let foodItems = [];
//         foodItems.push(foodItem);
//         localStorage.setItem("foodItem", JSON.stringify(foodItems));
//       } else {
//         // if the cart is not empty, get the food items in the cart
//         let foodItems = JSON.parse(localStorage.getItem("foodItem"));
//         // check if the food item is already in the cart
//         let foodItemExists = foodItems.find(
//           (item) => item.foodName === foodItem.foodName
//         );
//         if (foodItemExists) {
//           // if the food item is already in the cart, alert the user
//           alert("Food item already in the cart");
//         } else {
//           // if the food item is not in the cart, push the food item
//           foodItems.push(foodItem);
//           localStorage.setItem("foodItem", JSON.stringify(foodItems));
//         }
//       }
//       // change the button color to green
//       $(this).find("button").toggleClass("is-success");
//       // change the button text to "Added"
//       $(this).find("button").text("Added");
//       // disable the button
//       $(this).find("button").attr("disabled", true);

//       setTimeout(() => {
//         $(".notification").remove();
//         location.reload();
//       }, 1000);
//     },
//   });
// });
