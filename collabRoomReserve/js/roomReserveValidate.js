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
			},
			timeStart: {
				required: true
			},
			timeEnd: {
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
		
	});
});
