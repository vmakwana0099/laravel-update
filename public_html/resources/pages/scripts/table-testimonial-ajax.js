var gridRows = 0;
var grid;
var TableDatatablesAjax = function() {
    var initPickers = function() {
    }
    var handleRecords = function() {
        grid = new Datatable();
        grid.init({
            src: $("#testimonial_datatable_ajax"),
            onSuccess: function(grid, response) {
                if (response.recordsTotal < 1) {
                    $('.deleteMass').hide();
                } else {
                    $('.deleteMass').show();
                }
            },
            onError: function(grid) {
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
                if ($('.pagination-panel .prev').hasClass('disabled')) {
                    $("#testimonial_datatable_ajax tbody tr:first").find('.moveUp').hide();
                }
                if ($('.pagination-panel .next').hasClass('disabled')) {
                    $("#testimonial_datatable_ajax tbody tr:last").find('.moveDwn').hide();
                }
                $('.make-switch').bootstrapSwitch();
            },
            loadingMessage: 'Loading...',
            dataTable: {
                "deferRender": true,
                "stateSave": true,
                "lengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100]
                ],
                "pageLength": 10,
                "serverSide": true,
                "columns": [{
                        "data": 0,
                        className: 'td_checker',
                        'bSortable': false
                    }, {
                        "data": 1,
                        className: 'text-left',
                        'name': 'varTitle'
                    }, {
                        "data": 2,
                        className: 'text-center',
                        'bSortable': false
                    }, {
                        "data": 3,
                        className: 'text-center',
                        'bSortable': false
                    },{
                        "data": 4,
                        className: 'text-center',
                        'bSortable': false
                    }, {
                        "data": 5,
                        className: 'text-center',
                        'bSortable': false
                    }, {
                        "data": 6,
                        className: 'text-center',
                        'name': 'dtStartDateTime'
                    },  {
                        "data": 7,
                        className: 'text-center',
                        'name': 'dtStartDateTime'
                    }, {
                        "data": 8,
                        className: 'text-right',
                        "name": 'intDisplayOrder'
                    }, {
                        "data": 9,
                        className: 'text-center publish_switch',
                        'bSortable': false
                    },
                    {
                        "data": 10,
                        className: 'text-right',
                        'bSortable': false
                    },
                    {
                        "data": 11,
                        'bSortable': false
                    }],
                "columnDefs": [{
                        "targets": [11],
                        "visible": false,
                        "searchable": false
                    }],
                "ajax": {
                    "url": window.site_url + "/powerpanel/testimonial/get_list",
                },
                'fnCreatedRow': function(nRow, aData, iDataIndex) {
                    $(nRow).attr('data-order', aData[11]);
                },
                "order": [
                    [8, "desc"]
                ]
            }
        });
        $('#testimonial_datatable_ajax tbody').on('click', '.moveDwn', function() {
            var order = $(this).data('order');
            var exOrder = $('#testimonial_datatable_ajax tbody').find('tr[data-order=' + order + ']').next().data('order');
            exOrder = (exOrder == undefined) ? order + 1 : exOrder;
            reorder(order, exOrder);
        });
        $('#testimonial_datatable_ajax tbody').on('click', '.moveUp', function() {
            var order = $(this).data('order');
            var exOrder = $('#testimonial_datatable_ajax tbody').find('tr[data-order=' + order + ']').prev().data('order');
            exOrder = (exOrder == undefined) ? order - 1 : exOrder;
            reorder(order, exOrder);
        });
        grid.getTableWrapper().on('keyup', '#searchfilter', function(e) {
            e.preventDefault();
            var action = $("#searchfilter", grid.getTableWrapper());
            if (action.val() != " ") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("searchValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else if (action.length < 1) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("searchValue", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });
        $(document).on('click', '#dateFilter', function(e) {
            var dateValue = $('#testimonialdate').val();
            if (dateValue != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("dateValue", dateValue);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("dateValue", dateValue);
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });
        $(document).on('change', '#statusfilter', function(e) {
            e.preventDefault();
            var action = $('#statusfilter').val();
            if (action != "") {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("statusFilter", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
            } else {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("statusFilter", action);
                grid.setAjaxParam("id", grid.getSelectedRows());
            }
        });
        $(document).on("switchChange.bootstrapSwitch", ".publish", function(event, state) {
            //e.preventDefault();
            var controller = $(this).data('controller');
            var alias = $(this).data('alias');
            var val = $(this).data('value');
            var url = site_url + '/' + controller + '/publish';
            $.ajax({
                url: url,
                data: {
                    alias: alias,
                    val: val
                },
                type: "POST",
                dataType: "HTML",
                success: function(data) {
                    grid.getDataTable().ajax.reload(null, false);
                },
                error: function() {
                    console.log('error!');
                }
            });
        });
        $(document).on('click', '#resetFilter', function(e) {
            grid.setAjaxParam("dateValue", null);
            grid.getDataTable().ajax.reload();
        });
        grid.setAjaxParam("customActionType", "group_action");
        grid.clearAjaxParams();
        grid.getDataTable().columns().iterator('column', function(ctx, idx) {
            $(grid.getDataTable().column(idx).header()).append('<span class="sort-icon"/>');
        });
    }
    return {
        init: function() {
            initPickers();
            handleRecords();
        }
    };
}();
jQuery(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
    TableDatatablesAjax.init();
});

function reorder(curOrder, excOrder) {
    var ajaxurl = site_url + '/powerpanel/testimonial/reorder';
    $.ajax({
        url: ajaxurl,
        data: {
            order: curOrder,
            exOrder: excOrder
        },
        type: "POST",
        dataType: "HTML",
        success: function(data) {
        },
        complete: function() {
            grid.getDataTable().ajax.reload(null, false);
        },
        error: function() {
            console.log('error!');
        }
    });
}
function makeFeatured(fid, status) {
    var ajaxurl = site_url + '/powerpanel/testimonial/makeFeatured';
    $.ajax({
        url: ajaxurl,
        data: {id: fid, featured: status},
        type: "POST",
        dataType: "json",
        success: function(data) {
        },
        complete: function() {
            grid.getDataTable().ajax.reload(null, false);
        },
        error: function() {
            console.log('error!');
        }
    });
}