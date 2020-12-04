var nieuwsBrief;

$(document).ready(function(){
	
	$(".btn-group").on("click","#sidebar_save",(event) => {
		sendNieuwsBrief();
		// console.log('id saved nieuwsbrief ' + );
	});
	$(".btn-group").on("click","#sidebar_save_return",(event) => {
		sendNieuwsBrief();
		console.log('#sidebar_save_return done');
		window.location.href = "https://on3.synology.me/terri/nieuwsbrief/nieuwsbrief.php";
	});
	$(".btn-group").on("click","#sidebar_save_send",(event) => {
		sendNieuwsBrief(true);
	});
	$(".btn-group").on("click","#sidebar_see_saved",(event) => {
		console.log(event);
		// openNieuwsBrief();
	});
	
	$(".btn-group").on("click","#content_edit_save",(event) => {
		sendNieuwsBrief();
		console.log('#content_edit_save done');
	});
	$(".btn-group").on("click","#content_edit_save_return",(event) => {
		sendNieuwsBrief();
		console.log('#content_edit_save_return done');
		window.location.href = "https://on3.synology.me/terri/nieuwsbrief/nieuwsbrief.php";
	});
	$(".btn-group").on("click","#content_edit_save_send",(event) => {
		sendNieuwsBrief(true);
	});
	
});

function sendNieuwsBrief(send) {

	let newJob = {		
		email: $("#email").val(),		
		kopinleiding: $("#kopinleiding").val(),
		inleiding: $("#inleiding").val(),
		kopinhoud: $("#kopinhoud").val(),
		inhoud: $("#inhoud").val(),
		titel1: $("#titel1").val(),
		body1: $("#body1").val(),
		titel2: $("#titel2").val(),
		body2: $("#body2").val(),
		titel3: $("#titel3").val(),
		body3: $("#body3").val(),
		titel4: $("#titel4").val(),
		body4: $("#body4").val(),
		titel5: $("#titel5").val(),
		body5: $("#body5").val(),
		titel6: $("#titel6").val(),
		body6: $("#body6").val(),
		titel7: $("#titel7").val(),
		body7: $("#body7").val(),
		titel8: $("#titel8").val(),
		body8: $("#body8").val()
	};
	if(send)
		newJob.get = "save_send";
	else
		newJob.get = "save";
	nieuwsBrief = newJob;
	
	$.ajax({
		type: "POST",
		url: "https://on3.synology.me/terri/nieuwsbrief/nieuwsbrief.php",
		data: JSON.stringify(nieuwsBrief),
		contentType: "application/json; charset=utf-8",
		// dataType: "html",
		dataType: "data",
		Success: function(reply){
			// console.log(reply);
			if (reply.includes("mail is sent")) 
				alert("Nieuwsbrief is verzonden");				
			$("html").scrollTop(0);
			return (reply);			
		},
		failure: function(errMsg) {
			alert(errMsg);
		}
	})
	// .done(function( html ) {
		// location.reload();
	// });
	
}

function saveNieuwsBrief() {
	return true;
}