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

  // Row select
  // -------------------------------------------------------------------

  $(".link-row").click(function () {
    const checkbox = $(`#${$(this).data("checkbox")}`);

    $(this).toggleClass("link-row--selected");

    if ($(this).hasClass("link-row--selected")) {
      checkbox.prop("checked", true);
    } else {
      checkbox.prop("checked", false);
    }
  });
});
