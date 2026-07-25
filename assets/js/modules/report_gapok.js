$('#user_id').select2();

$(document).ready(function(){
	$('#from_date').datepicker({
		format: 'yyyy-mm-dd', 
		maxDate: new(Date), 
		yearRange: 2, 
		autoClose: true
	});

	$('#to_date').datepicker({		
		format: 'yyyy-mm-dd', 
		maxDate: new(Date), 
		yearRange: 2, 
		autoClose: true, 
		onOpen: function() {
			var d = new Date($('#from_date').val());
			var start_date = d.setDate(d.getDate() - 1);
			this.options.minDate = new Date(start_date);
		}
	});
	
	
	var url = $('#wrap-search').data('url'); 
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var user_id = $('#user_id').val();

	$.ajax({
		url: url, 
		type: 'POST', 
		data: {from_date: from_date, to_date: to_date, user_id: user_id}, 
		success: function(response){
			$('#showTable').html(response);
		}
	});
});

$(document).on('change', '#from_date', function(){
	var url = $('#wrap-search').data('url'); 
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var user_id = $('#user_id').val();
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {from_date: from_date, to_date: to_date, user_id: user_id}, 
		success: function(response){
			$('#showTable').html(response);
		}
	});
});

$(document).on('change', '#to_date', function(){
	var url = $('#wrap-search').data('url'); 
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var user_id = $('#user_id').val();
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {from_date: from_date, to_date: to_date, user_id: user_id}, 
		success: function(response){
			$('#showTable').html(response);
		}
	});
});

$(document).on('change', '#user_id', function(){
	var url = $('#wrap-search').data('url'); 
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var user_id = $('#user_id').val();
	
	$.ajax({
		url: url, 
		type: 'POST', 
		data: {from_date: from_date, to_date: to_date, user_id: user_id}, 
		success: function(response){
			$('#showTable').html(response);
		}
	});
});
