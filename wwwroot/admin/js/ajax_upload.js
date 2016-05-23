(function(){
	$('#imageform').ajaxForm({
		beforeSubmit: function() {	
			count = 0;
			val = $.trim( $('#images').val() );
			
			if( val == '' ){
				count= 1;
				$( "#images" ).next('span').html( "Please select your images" );
			}
			
			if(count == 0){
				for (var i = 0; i < $('#images').get(0).files.length; ++i) {
			    	img = $('#images').get(0).files[i].name;
			    	var extension = img.split('.').pop().toUpperCase();
			    	if(extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
			    		count= count+ 1
			    	}
			    }
				if( count> 0) $( "#images" ).next('span').html( "Please select valid images" );
			}
		    
		    if( count> 0){
		    	return false;
		    } else {
		    	$( "#images" ).next('span').html( "" );
		    }
	    },
		
		beforeSend:function(){
		   $('#loader').show();
		   $('#image_upload').hide();
		},
	    success: function(msg) {
	    },
		complete: function(xhr) {
			$('#loader').hide();
			$('#image_upload').show();
			
			$('#images').val('');
			$('#error_div').html('');
			result = xhr.responseText;
			result = $.parseJSON(result);
			base_path = "/";
			
			if( result.success ){
				var name = result.success.path;
				var thumb = result.success.thPath; 
				//$("section#edit .picture-medium img").attr("src",name);
				$(".row.picture").attr("data-id",result.success.id);
				$("#Path").attr("src",name);
				$("#ThPath").text(thumb);
				$("#CheckUpload").removeAttr("checked");
			} else if( result.error ){
				error = result.error
				html = '';
				html+='<p>'+error+'</p>';
				$('#picture-error').append( html );
			}

			$('#picture-error').delay(10000).fadeOut('slow');
		}
	}); 
	
})();   