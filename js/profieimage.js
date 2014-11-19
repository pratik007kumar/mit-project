(function() {
    // $('#imageform').submit(function(event) {
       
	$('#imageform').ajaxForm({
		beforeSubmit: function() {	
			count = 0;
			val = $.trim( $('#gimages').val() );
			
			if( val == '' ){
				count= 1;
				alert( "Please select  images" );
			}
			
			if(count == 0){
				for (var i = 0; i < $('#gimages').get(0).files.length; ++i) {
			    	img = $('#gimages').get(0).files[i].name;
			    	var extension = img.split('.').pop().toUpperCase();
			    	if(extension!="PNG" && extension!="JPG"  && extension!="JPEG"){
			    		count= count+ 1
			    	}
			    }
				if( count> 0) alert( "Please select valid images" );
			}
		    
		    
		    if( count> 0){
		    	return false;
		    } else {
		    	$( "#gimages" ).next('span').html( "" );
		    }
			
			
			 
	    },
		
		beforeSend:function(){
            $("#upbtn").attr('disabled','disabled');
		    $('#upbtnlod').html('Loding... <i class="fa fa-spinner   fa-spin  "></i>');
		},
	    success: function(msg) {
	    },
		complete: function(xhr) {
			result = xhr.responseText;
			result = $.parseJSON(result);
			//base_path = $('#base_path').val();
			
                         $('#upbtnlod').html('');
                         $("#upbtn").removeAttr('disabled');
			if( result.success=='1' ){
                            $('#gimages').val('');
                            $('#fst').after(result.data);
                           // alert(result.src);
			//$('#coverimage-div').css('background','url('+'uploades/coverimage/org/'+result.src+')');
                        
                         //  $('#cover-modal').modal('hide');     
			} else if( result.error ){
				error = result.error
				alert(error);
			}
				
			
			//$('#error_div').delay(5000).fadeOut('slow');


		}
	}); 
       //  event.preventDefault();
   //  });
	
})();  