$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/*
* add new element
* */
function add(id) { // format id : number_number
    var tmp_id = genarateId(id, 1);
    var setting = $('#setting-html-row');
    $.ajax({
        type : 'POST',
        data: {
          'id' : tmp_id
        },
        url : SITE_ROOT + 'add-form-setting',
        success : function(data) {
            var firstChild = $('#' + id).children().first();
            $(data).insertAfter($(firstChild));
        }
    }).done(function() {
        orderID(id);
    });
}

/*
* genarate id
* auto generate id, if id is exist, back ro generate
* */
function genarateId(id, ownOrder) {
    var tmpID = id + '_' + ownOrder;
    var count = $('#' + tmpID).length;
    if(count > 0) {
        ownOrder = ownOrder + 1;
        return genarateId(id, ownOrder);
    } else {
        return id + '_' + ownOrder;
    }
}

/*
* orderID
* sort element by id
* */
function orderID(parentID) {
    $("#"+ parentID).children().slice(1).sort(function(a, b) {
        var aID = a.id;
        var aOrderArray = aID.split('_');
        var aOrder = aOrderArray[aOrderArray.length - 1];
        var bID = b.id;
        var bOrderArray = bID.split('_');
        var bOrder = bOrderArray[bOrderArray.length - 1];
        return parseInt(aOrder) - parseInt(bOrder);
    }).each(function() {
        var elem = $(this);
        elem.remove();
        $(elem).appendTo("#" + parentID);
    });
}

/*
* remove item
* */
function remove(id) {
    $('#' + id).remove();
}

/*
* get table field append to select box
* */
$('#selectTable').on('change', function() {
    tableChange();
});

function tableChange() {
    var table_name = $('#selectTable').val();
    //set table name to modal.
    $('#myModalLabel').html('Table : ' + table_name);

    //set field to select box
    $.ajax({
        type : 'POST',
        data: {
            'tableName' : table_name
        },
        url : SITE_ROOT + 'get-table-field',
        success : function(data) {
            $('#selectFieldBox').empty().append(data);
        }
    });
}

/*
* select field
* */
function selectField(id) {
    var table = $('#selectTable').val();
    if(table == '') {
        alert('please select table name !');
    } else {
        $('#modalSelectField').modal('show');
        $('#hidID').val(id);
    }
}

function selectedField() {
    var id = $('#hidID').val();
    var field = $('#selectField').val();
    $('#field-' + id).html(field);
    $('#hid-field-' + id).val(field);
    $('#modalSelectField').modal('toggle');
}

function save_setting() {
    var form = $('#form-setting');
    $.ajax({
        type : 'POST',
        data: {
            'data' : form.serializeObject()
        },
        url : SITE_ROOT + 'save-setting',
        success : function(data) {
            alert(data);
        }
    });
}

/*
* Check duplicate name setting
* */
function checkDuplicate(val) {
    if(val == '') {
        $('#mes-duplicate').html('');
        return;
    }
    $.ajax({
        type : 'POST',
        data: {
            'name' : val
        },
        url : SITE_ROOT + 'check-name',
        success : function(data) {
            if(data) {
                $('#mes-duplicate').html('This name is duplicated !');
                $('#btn-save-setting').attr('disabled', 'disabled');
            } else {
                $('#mes-duplicate').html('');
                $('#btn-save-setting').prop('disabled', false);
            }
        }
    });
}

/*
* load setting
* */
$('#select-setting').on('change', function() {
    var value = $(this).val();
    $.ajax({
        type : 'POST',
        data: {
            'order' : value
        },
        url : SITE_ROOT + 'load-setting',
        success : function(data) {
            $('#selectTable').val(data.order.table);
            $('#url').val(data.order.url);
            $('#setting-name').val(data.order.name);
            tableChange();

            $.each(data.setting, function() {
                //load item
                var parent = findParent(this.name);
                $.ajax({
                    type : 'POST',
                    data: {
                        'id' : this.id
                    },
                    url : SITE_ROOT + 'load-setting-item',
                    success : function(data) {
                        if(parent != '') {
                            setTimeout(function() {
                                $('#' + parent).append(data);
                            }, 2000);
                        } else {
                            setTimeout(function() {
                                $('#setting-html-row').html(data);
                            }, 2000);
                        }
                    },
                });
            });
        }
    });
});

/*
* function find parent for id of children
* */
function findParent(id) {
    var arrExp = id.split('_');
    var parent = '';
    if(arrExp.length > 1) {
        arrExp.pop();
        var parent = arrExp.join('_');
    }

    return parent;
}