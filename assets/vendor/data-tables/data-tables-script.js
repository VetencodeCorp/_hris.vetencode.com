$(document).ready(function(){
    var simpleTable = $('#data-table-simple');

    if (simpleTable.length && !$.fn.dataTable.isDataTable(simpleTable[0])) {
        simpleTable.DataTable({
            lengthChange: false,
            pageLength: 10,
            autoWidth: false,
            language: {
                search: '',
                searchPlaceholder: 'Cari data...',
                emptyTable: 'Belum ada data.',
                zeroRecords: 'Data tidak ditemukan.',
                info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
                infoEmpty: 'Belum ada data',
                infoFiltered: '(disaring dari _MAX_ data)',
                paginate: {
                    previous: '‹',
                    next: '›'
                }
            },
            initComplete: function(){
                $('#data-table-simple_filter input')
                    .attr('aria-label', 'Cari data')
                    .attr('placeholder', 'Cari data...');
            },
            drawCallback: function(){
                $('.tooltipped').tooltip();
            }
        });
    }
    
    var table = $('#data-table-row-grouping').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    });
 
    // Order by the grouping
    $('#data-table-row-grouping tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
});
