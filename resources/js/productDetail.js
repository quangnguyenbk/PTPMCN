$( document ).ready(function() {
    productDetail.init();
});
 
var productDetail = function(){
	var init = function(){
		initElement();
	}

	var initElement = function(){
		$("#price").text(formatCurrency(laptop.price));
	}

	return {
		init: init,
	}
}();