function showNotification() {
  $(function () {
    // Show or hide the notification bar or reminder bar
    $("#show").on("click", function (event) {
      event.preventDefault();
      $("#reminder").show(2000);
      $(".close").show();
    });

    $(".close").on("click", function (event) {
      $("#reminder").hide(1000);
      $(".close").hide();
      $("#show").show();
    });
  });
}

showNotification();