function makeGetHint(url) {
  return function getHint(field, value) {
    let valfieldate = $.ajax({
      url: url,
      method: "POST",
      data: {
        field,
        value,
      },
      dataType: "text",
    });

    valfieldate.done(function (text) {
      $(`#${field} + .error`).text(text);
    });
  };
}
