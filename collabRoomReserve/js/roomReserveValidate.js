$.validator.addMethod("matches", function(value, element, param) {
   return this.optional(element) || value.match(param);
},
'Please enter a valid value.');


$(document).ready(function() {
    $('#theForm').validate({
		rules: {
			roomNum: {
				required: true,
				minlength: 2
			},
			primEmail: {
				required: true,
				matches: ".+@marist.edu"
			},
			secEmail: {
				required: true,
				matches: ".+@marist.edu"
			},
			resDate: {
				required: true
			}
			
		},
		messages: {
			primEmail: {
				required: "<br>Please enter a valid marist.edu email address.",
				matches: "<br>Please enter a valid marist.edu email address."
			},
			secEmail: {
				required: "<br>Please enter a valid marist.edu email address.",
				matches: "<br>Please enter a valid marist.edu email address."
			},
			roomNum: "<br>Please enter a valid room number."
		}
		submitHandler: function(form) {
			$.ajax({
		        url: "verifyReserveForm.php",
		        type: "post",
		        data: $(form).serialize(),
		        // callback handler that will be called on success
		        success: function(response){
		            if (response==1 && $("#theForm").valid()) {
		                document.location.href="<?php echo base_url("?c=crr&m=verify"); ?>";
		            } else if (response==0) {
			                $("#after_submit").html('');
			                $("#reset").after('<div><label class="error" id="after_submit">Invalid captcha code.</label></div>');
		              }
			    }
	        });
		}
	});
});
