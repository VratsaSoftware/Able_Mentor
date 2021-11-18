$(document).ready( function () {
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        language: {
            "sProcessing": "Обработка на резултатите...",
            "sLengthMenu": "Показване на _MENU_ резултата...",
            "sZeroRecords": "Няма намерени резултати",
            "sInfo": "Показване на резултати от _START_ до _END_ от общо _TOTAL_",
            "sInfoEmpty": "Показване на резултати от 0 до 0 от общо 0",
            "sInfoFiltered": "(филтрирани от общо _MAX_ резултата)",
            "sInfoPostFix": "",
            "sSearch": "Търсене:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Първа",
                "sPrevious": "Предишна",
                "sNext": "Следваща",
                "sLast": "Последна"
            },
        },
        order: [[ 0, "desc" ]],
    });
});
