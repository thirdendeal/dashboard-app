function ajax(url) {
  return function ajaxField(id, value) {
    let validate = $.ajax({
      url: url,
      method: "POST",
      data: {
        id,
        value,
      },
      dataType: "text",
    });

    validate.done(function (text) {
      $(`#${id} + .error`).text(text);
    });
  };
}
