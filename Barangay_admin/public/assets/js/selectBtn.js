$(document).ready(function () {
  $(".selectBtn").on({
    click: function (e) {
      e.preventDefault();
      $(this).find("button").toggleClass("is-success");

      setTimeout(() => {
        // get the price of the food item
        let price = $(this).find("span").eq(1).text();
        // get the name of the food item
        let foodName = $(this).find("span").eq(2).text();
        let foodNameTrim = foodName.trim();

        sessionStorage.setItem("price", price);
        sessionStorage.setItem("foodName", foodNameTrim);
        
        // redirect to page3
        // window.location.href = "/Millona/page3/";

        // get the root path of the website
        let rootPath = window.location.origin;

        // // get the current base url

        location.href = rootPath + "/Millona/page3/"; 


      }, 1000);
    },
  });
});
