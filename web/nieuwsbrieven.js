function ViewModel() {
	var self = this;

	self.nieuwsbrieven = ko.observableArray();	
	self.loadNieuwsbrieven = function() {	
		makeRequest('getNieuwsbrieven')
			.then(function(result){self.nieuwsbrieven(result)})
			.catch(function(error){console.log('Something went wrong', error);});
	}
	
	self.nieuwsbrief = ko.observable();
	self.openNieuwsbrief = function(e) {
		// console.log("openNieuwsbrief triggered!");
		_query = { id: e.id};
		makeRequest('openNieuwsbrief')
			.then(function(result){
				// console.log(result);
				self.nieuwsbrief(result);
			})
			.catch(function(error){console.log('Something went wrong', error);});
		$('.closePopup').fadeIn(300);
		$("html").css("overflow-y","hidden");
		// $("#nieuwsbriefPopup").css("overflow-y","scroll");
		$(document).bind("keyup", function(e){
			if(e.which == 27) //escape knop
				self.closePopup();
		});
	}
	
	self.closePopup = function(data,event){ 		
			$('.closePopup').fadeOut(300);
			// $('#cover').fadeOut(150);
			$("html").css("overflow-y","scroll");
			$(document).unbind("keyup");
			self.nieuwsbrief = (null);
	}
	
};

var _query = { nieuwsbrieven:{sortDir: 'DESC', sortColumn: 'dateCreation'}};

var viewModel = new ViewModel();
			 
$(document).ready(function(){
	
	$("#createNieuwsbriefButton").click(function(event) {
		createNieuwsbrief();
	});

	ko.applyBindings(viewModel);
	viewModel.loadNieuwsbrieven();
	
});

function createNieuwsbrief() {
	url = "" + '?createNieuwsbrief=1';
	location.href = url;
	location.reload(forceGet);
}

function makeRequest(doThis) {	
	// $('#refresh>i').addClass('fa-spin');
	var request = new XMLHttpRequest();
	return new Promise(function (resolve, reject) {
		request.onreadystatechange = function () {
			if (request.readyState !== 4) return;
			// $('#refresh>i').removeClass('fa-spin');
			if (request.status >= 200 && request.status < 300) {
				let result = JSON.parse(request.responseText);
				resolve(result);
			}
			else {
				reject({
					status: request.status,
					statusText: request.statusText
				});
			}
		};
		request.open('POST','', true);
		request.setRequestHeader("Content-type", "application/json");
		_query.get = doThis;
		request.send(JSON.stringify(_query));
	});
};