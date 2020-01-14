<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="hotel_enquiry fright container">
	<div class="enquiry_heading"><h2><script type="text/javascript" language="javascript" src="blink.js"></script><span id="highlight" style="color: rgb(0, 240, 80);">Online Enquiry</span></h2></div>
	<div class="form">		
		<form name="contactForm" id="frmContact" method="post"
            action="send.php" enctype="multipart/form-data">

            <div class="input-row">
                <label style="padding-top: 20px;">Name</label> <span
                    id="userName-info" class="info"></span><br /> <input
                    type="text" class="input-field" name="name"
                    id="userName" />
            </div>
			<div class="input-row">
                <label>Phone</label> <span id="subject-info"
                    class="info"></span><br /> <input type="number"
                    class="input-field" name="phone" id="phone" />
            </div>
            <div class="input-row">
                <label>Email</label> <span id="userEmail-info"
                    class="info"></span><br /> <input type="email"
                    class="input-field" name="userEmail" id="userEmail" />
            </div>
            
            <div class="input-row">
                <label>Country</label> <span id="userMessage-info"
                    class="info"></span><br />                
				<input type="text" class="input-field" name="country" id="country" />	
            </div>
            <div>
                <input type="submit" name="send" class="btn-submit"
                    value="Send" />

                <div id="statusMessage"> 
                       
                </div>
            </div>
        </form>
	</div>
</div>  
    <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>
    <script type="text/javascript">
        function validateContactForm() {
            var valid = true;

            $(".info").html("");
            $(".input-field").css('border', '#e0dfdf 1px solid');
            var userName = $("#userName").val();
            var userEmail = $("#userEmail").val();
            var phone = $("#phone").val();
            var country = $("#country").val();
            
            if (userName == "") {
                $("#userName-info").html("Required.");
                $("#userName").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (userEmail == "") {
                $("#userEmail-info").html("Required.");
                $("#userEmail").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
            {
                $("#userEmail-info").html("Invalid Email Address.");
                $("#userEmail").css('border', '#e66262 1px solid');
                valid = false;
            }

            if (phone == "") {
                $("#subject-info").html("Required.");
                $("#phone").css('border', '#e66262 1px solid');
                valid = false;
            }
            if (country == "") {
                $("#userMessage-info").html("Required.");
                $("#country").css('border', '#e66262 1px solid');
                valid = false;
            }
            return valid;
        }
	</script>
	<script>
	jQuery("#frmContact").submit(function(e) {
		e.preventDefault();
		var valid;	
		valid = validateContactForm();
		if(valid){
			
			jQuery('.loader').show();
			jQuery('.loader').html('<div class="loader-text">PLEASE WAIT...</div>');
			jQuery("input,select,textarea").css('border','#e0dfdf 1px solid');
			jQuery('.mes').remove();
			var url = jQuery(this).attr('action');
			var formData = new FormData(jQuery(this)[0]);	
			jQuery.ajax({
					type: "POST",
					url: url,
					data:  formData, 
					processData: false,
					dataType:'json',
					contentType: false,
					success: function(data)
					{
					 
					if(data.status== false){
						jQuery('#statusMessage').html(data.message);  
			
						var a= data['errors'];
			 
						jQuery.each(data.errors, function(key, value){
				   
						jQuery("input[name='"+key+"'],select[name='"+key+"'],textarea[name='"+key+"']").css('border','2px solid red');
		 
						jQuery("input[name='"+key+"'],select[name='"+key+"'],textarea[name='"+key+"']").after("<small class='mes'>"+value+"</small>");
					});
					}
				if(data.status==true){

						jQuery("input[type=text],select,textarea").css('border','2px solid #1abb9c').delay( 2000 ).css('border','1px solid #e2e2e4');
						jQuery("input[type=text],select,textarea").val('');
						jQuery('#statusMessage').html(data.message);  
						jQuery("#statusMessage").fadeIn(100);

						jQuery("html, body").animate({				

						scrollTop: jQuery("#statusMessage").offset().top-100

						}, 1000);

						jQuery("#statusMessage").delay(3000);
				
					}
						jQuery('.loader').hide(); 
						
				   }
				 });
		}		 
	});
	</script>
</body>
</html>

