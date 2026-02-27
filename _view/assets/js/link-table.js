$(document).ready(function () {
  // Row hover
  // -------------------------------------------------------------------

  $(".link-row").hover(
    function () {
      $(this)
        .children()
        .each(function () {
          $(this).css("background-color", "blanchedalmond");
        });
    },
    function () {
      $(this)
        .children()
        .each(function () {
          $(this).removeAttr("style");
        });
    },
  );

  // Row link
  // -------------------------------------------------------------------

  $(".link-row").click(function () {
    window.location = $(this).data("href");
  });
});
