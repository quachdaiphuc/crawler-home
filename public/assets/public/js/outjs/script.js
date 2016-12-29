/*
 * change price
 * */
function orderPrice(value) {
    $('.link-filter').attr('href', '?order=' + value);
}

function changeURL() {
    var priceFrom = $('[name=priceFrom]').val();
    var priceTo = $('[name=priceTo]').val();
    if(priceFrom == '') {
        $('.priceFrom').html('');
    }
    if(priceTo == '') {
        $('.priceTo').html('');
    }
}

/*
 * search product list by category
 * */
function search() {
    var select = $('#scroll-select').val();// array parent category id
    var arr = [];
    for(var i = 0; i < select.length; i ++) {
        var checkbox = $('.icheck-' + select[i]);
        for(var j = 0; j < checkbox.length; j ++) {
            if($(checkbox[j]).is(':checked')) {
                arr.push($(checkbox[j]).val());
            }
        }
    }
    alert(arr);
}

/*
 * change category for filter
 * */
function chooseCategoryFilter(obj) {
    var valueList = $(obj).val();
    var checkItem = $('.checkbox-search-parent');
    var arr = [];

    if(valueList == undefined) {
        for(var i = 0; i < checkItem.length; i ++) {
            $('#'+$(checkItem[i]).attr('id')).hide('slow');
            var res = $(checkItem[i]).attr('id').split('-');
            var check = $('.icheck-'+ res[1]);
            for(var j = 0; j < check.length; j ++) {
                if($(check[j]).is(':checked')) {
                    $(check[j]).iCheck('uncheck');
                }
            }
        }
    }

    $.each(valueList, function(index, value){
        arr[index] = 'item-'+ value;
    });

    for(var i = 0; i < checkItem.length; i ++) {
        if($.inArray($(checkItem[i]).attr('id'), arr) != -1) {
            $('#'+$(checkItem[i]).attr('id')).show('slow');
        } else {
            $('#'+$(checkItem[i]).attr('id')).hide('slow');
            var res = $(checkItem[i]).attr('id').split('-');
            var check = $('.icheck-'+ res[1]);
            for(var j = 0; j < check.length; j ++) {
                if($(check[j]).is(':checked')) {
                    $(check[j]).iCheck('uncheck');
                }
            }
        }
    }
}