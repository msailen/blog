$(document).on("submit", "#register-form", function (e) {
  e.preventDefault();
  const _form = $(this);
  const _error = $(".register-error", _form);

  const payload = {
    name: $("input[name='name']", _form).val(),
    email: $("input[type='email']", _form).val(),
    password: $("input[name='password']", _form).val(),
  };

  if (payload.password.length < 6) {
    _error
      .text("Please enter a password that is at least 6 characters long.")
      .show();
    return;
  }

  _error.hide();

  $.ajax({
    type: "POST",
    url: "/ajax/register.php",
    data: payload,
    dataType: "json",
    async: true,
  })
    .done((data) => {
      if (data?.redirect) {
        window.location = data.redirect;
      } else if (data?.error) {
        _error.text(data.error).show();
      }
    })
    .fail((e) => {
      _error.text("Failed to Register").show();
    });
  return;
});
