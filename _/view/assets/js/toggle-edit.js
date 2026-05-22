$(document).ready(function () {
  // Initially hidden edit forms
  // -------------------------------------------------------------------

  $(".list__form").hide();

  // Show an edit form
  // -------------------------------------------------------------------

  $(".list__edit").click(function () {
    const form = $(this).prev();
    const p = form.prev();

    p.hide();
    $(this).hide();

    form.show();
  });

  // Rollback to on hide
  // -------------------------------------------------------------------

  let initialEditValues = {};

  $(".list__input").each(function () {
    const id = $(this).attr("id");
    const value = $(this).val();

    initialEditValues[id] = value;
  });

  // Hide an edit form
  // -------------------------------------------------------------------

  $(".list__cancel").click(function () {
    const padlock = $(this).parent();
    const form = padlock.parent();
    const p = form.prev();
    const edit = form.next();
    const input = form.find(".list__input");
    const id = input.attr("id");

    input.val(initialEditValues[id]); // rollback

    form.hide();

    p.show();
    edit.show();
  });
});
