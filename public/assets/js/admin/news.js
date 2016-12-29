var oTable;

$(document).ready(function () {
    oTable = $('#news').dataTable({
        "oLanguage": {
            "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [-1, 0]
            } //disables sorting for column one
        ],
        'iDisplayLength': 10,
        "sPaginationType": "full_numbers"
    });
});

/*
 * tmp save winner
 * */
function doAction( message, id){
    bootbox.dialog({
        message: message,
        title: 'Warning',
        buttons: {
            success: {
                label: "OK",
                className: "btn-success",
                callback: function() {
                    //delete record
                    $.ajax({
                        type : 'POST',
                        url : 'news/destroy',
                        data : {
                            'id' : id
                        },
                        success : function(data) {
                            window.location.reload();
                        }
                    });
                }
            },
            danger: {
                label: "Cancel",
                className: "btn-danger",
                callback: function() {

                }
            }
        }
    });
}