$(document).ready( function () {
    datatable('.datatable', [0, 'desc']);
    datatable('.matching-datatable', [4, 'desc']);
    datatable('.datatable-season', [1, 'desc']);
});

function datatable(className, columnOrder) {
    $(className).DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        responsive: false,
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
        order: columnOrder,
    });
}
