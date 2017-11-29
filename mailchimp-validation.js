require('jquery-validation')
$(document).ready(function() {
  $('#thirdparty_optin').change(function(){
     var cb = $(this);
     cb.val(cb.prop('checked'));
 });
  // jQuery Validation
  $("#newsletterSignup").validate({
      // if valid, post data via AJAX
      submitHandler: function(form) {
          $.post("subscribe.php", { fname: $("#fname").val(), lname: $("#lname").val(), email: $("#email").val(), province: $("#province").val(), optin: $("#thirdparty_optin").val() }, function(data) {
              $('#mce-responses').html(data);
          });
      },
      rules: {
          fname: {
              required: false
          },
          lname: {
              required: false
          },
          email: {
              required: true,
              email: true
          },
					province:{
						required: false
					},
          optin:{
						required: false
					}
      }
  });
});
