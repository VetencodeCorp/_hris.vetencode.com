(function($){
  $(function(){

	var sidebarStorageKey = 'hris_sidebar_collapsed';
	var $sidebarToggle = $('#sidebar-toggle');

	function syncSidebarToggle(){
		var isCollapsed = document.documentElement.classList.contains('sidebar-collapsed');
		$sidebarToggle.attr('aria-expanded', isCollapsed ? 'false' : 'true');
		$sidebarToggle.attr('aria-label', isCollapsed ? 'Tampilkan sidebar' : 'Sembunyikan sidebar');
	}

	try {
		if (localStorage.getItem(sidebarStorageKey) === '1') {
			document.documentElement.classList.add('sidebar-collapsed');
		}
	} catch (error) {
		// Sidebar tetap berfungsi walau browser memblokir localStorage.
	}

	syncSidebarToggle();

	$sidebarToggle.on('click', function(){
		document.documentElement.classList.toggle('sidebar-collapsed');
		var isCollapsed = document.documentElement.classList.contains('sidebar-collapsed');

		try {
			localStorage.setItem(sidebarStorageKey, isCollapsed ? '1' : '0');
		} catch (error) {
			// State hanya tidak tersimpan untuk kunjungan berikutnya.
		}

		syncSidebarToggle();
	});

    $('.sidenav').sidenav();
    $('.datepicker').datepicker();
    $('.tooltipped').tooltip();
    $('.modal').modal();
	$('.collapsible').collapsible();
	$('.materialboxed').materialbox();
	
  }); // end of document ready
})(jQuery); // end of jQuery name space
