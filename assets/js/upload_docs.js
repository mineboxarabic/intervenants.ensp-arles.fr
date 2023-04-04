///////// CNI
		$("#upload_cni").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_cni.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
					
					 beforeSubmit: function () {
    	        	alert('before');
    	            $("#progressDivId").css("display", "block");
    	            var percentValue = '0%';

    	            $('#progressBar').width(percentValue);
    	            $('#percent').html(percentValue);
    	       		 },
    	       		  uploadProgress: function (event, position, total, percentComplete) {

    	            var percentValue = percentComplete + '%';
    	            $("#progressBar").animate({
    	                width: '' + percentValue + ''
    	            }, {
    	                duration: 5000,
    	                easing: "linear",
    	                step: function (x) {
                        percentText = Math.round(x * 100 / percentComplete);
    	                    $("#percent").text(percentText + "%");
                        if(percentText == "100") {
                        	   $("#outputImage").show();
                        }
    	                }
    	            });
    	        },
					
					success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
					
		})); 
		
		
	///////// certif
		$("#upload_certif").on('submit',(function(e) {
				
				e.preventDefault();
			//	$("#message").empty();
			//	$('#loading').show();
					$.ajax({
						
					url: "upload_certif.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
					
		})); 
		
		
		///////// justi
		$("#upload_justifcpt").on('submit',(function(e) {
				
				e.preventDefault();
			//	$("#message").empty();
			//	$('#loading').show();
					$.ajax({
						
					url: "upload_justifcpt.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
					
		})); 
		
		///////// cv
		$("#upload_cv").on('submit',(function(e) {
				
				e.preventDefault();
			//	$("#message").empty();
			//	$('#loading').show();
					$.ajax({
						
					url: "upload_cv.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
					
		})); 
		
		
		
		
		///////// diplome
		$("#upload_diplome").on('submit',(function(e) {
				
				e.preventDefault();
			//	$("#message").empty();
			//	$('#loading').show();
					$.ajax({
						
					url: "upload_diplome.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
					
		})); 
		
				///////// photo
		$("#upload_photo").on('submit',(function(e) {
				
				e.preventDefault();
			//	$("#message").empty();
			//	$('#loading').show();
					$.ajax({
						
					url: "upload_photo.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
			///////// Bourse
		$("#upload_bourse").on('submit',(function(e) {
				
				e.preventDefault();
					$.ajax({
						
					url: "upload_bourse.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
					
		})); 
		
		///////// Portfolio
		$("#upload_portfolio").on('submit',(function(e) {
				
				e.preventDefault();
					$.ajax({
						
					url: "upload_port.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		///////// lf
		$("#upload_lf").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_lf.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		///////// lettre de motivation
		$("#upload_lm").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_lm.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		
		///////// lettre de recommandation
		$("#upload_lr").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_lr.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		///////// Copie Master
		$("#upload_master").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_master.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		
		///////// lettre de recommandation
		$("#upload_preinscr").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_preinscr.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		///////// Copie Master
		$("#upload_biblio").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_biblio.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		
		///////// Dossier Artistique
		$("#upload_da").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_da.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		 
		///////// Projet doctoral
		$("#upload_projdoc").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_projdoc.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		
		///////// Projet VAE
		$("#upload_VAECERFA").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_VAECERFA.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		///////// Justif VAE
		$("#upload_VAEjustif").on('submit',(function(e) {
				e.preventDefault();
					$.ajax({
					
					url: "upload_VAEjustif.php", // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false, 
				       // To send DOMDocument or non processed data file it is set to false
					   success: function(data)   // A function to be called if request succeeds
					   {
					   		$("#feedback").html("<p id='error' style='color:red'>"+data+"</p>");
							setTimeout(function(){
							location.reload(true);
						}, 2000);
					},
					 error: function () {
                    alert('Error');
                }
					});
					
		})); 
		
		
		
		
		

	$(".del_fichier").click(function(){
	if (confirm("Etes-vous sur de vouloir supprimer ce fichier ?"))
			{
			
			var id = $(this).attr('id');
			var data = 'id=' + id ;
				$.ajax(
				{
					  type: "POST",
     			   	  url: "delete_fichiers.php",
        				datatype: "html",
        				data:data,
        					
        				success: function(data){
        				setTimeout(function(){
							location.reload(true);
						}, 500);
					}
				 });
				 			
				return false;				
			}
 		 });

  
		



