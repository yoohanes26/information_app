<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        お知らせ設定
    </title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="/global_assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="/global_assets/js/main/jquery.min.js"></script>
    <script src="/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="/assets/js/app.js"></script>

    <script type="text/javascript">
        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
        $(document).ready(function() {
            var year = (new Date()).getFullYear();
            $('#year').html(year);
        });

    </script>
    <!-- /theme JS files -->

    <style>
        #modal_profile .modal-body{
            word-break: break-all;
        }
    </style>

    <script src="/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="../../../../global_assets/js/plugins/tables/datatables/extensions/select.min.js"></script>
        <script src="/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
    <script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="/global_assets/js/plugins/forms/validation/validate.min.js"></script>
    <script src="/global_assets/js/plugins/forms/validation/additional_methods.min.js"></script>
    <script src="/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script src="/global_assets/js/demo_pages/colors_success.js"></script>
    <script src="/global_assets/js/demo_pages/colors_danger.js"></script>

    <script type="text/javascript">
        var NotyJgrowl = function() {
            //
            // Setup module components
            //

            // Noty.js examples
            var _componentNoty = function() {
                if (typeof Noty == 'undefined') {
                    console.warn('Warning - noty.min.js is not loaded.');
                    return;
                }

                // Override Noty defaults
                Noty.overrideDefaults({
                    theme: 'limitless',
                    layout: 'topRight',
                    type: 'alert',
                    timeout: 2500
                });
            }

            return {
                init: function() {
                    _componentNoty();
                }
            }
        }();

        var DatatableCustomButtonWithSearch = function() {


            //
            // Setup module components
            //

            // Basic Datatable examples
            var _componentDatatableAPI = function() {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }

                // Setting datatable defaults
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    columnDefs: [
                        // {
                        //     width: 300,
                        //     targets: [ 1 ]
                        // },
                    ],
                    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>フィルター:</span> _INPUT_',
                        searchPlaceholder: 'フィルターを入力...',
                        lengthMenu: '<span>Show:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                    }
                });

                // Individual column searching with text inputs
                $('.datatable-button-init-custom thead td').not('#ignore_search_field').each(function () {
                    var title = $('.datatable-button-init-custom thead th').eq($(this).index()).text();
                    $(this).html('<input type="text" id="col' + $(this).index() + '_filter" class="form-control input-sm" placeholder="'+title+'" />');
                });

                var table = $('.datatable-button-init-custom').DataTable({
                    order: [0, "asc"],
                    processing: true,
                    serverSide: true,
                    ajax: "/information",
                    pageLength: 100,
                    scrollCollapse: true,
                    scrollY: '500px',
                    select: {
                        style: 'single'
                    },
                    dom: 'ftipB',
                    buttons: [
                        {
                            text: '登録',
                            className: 'btn bg-teal-400',
                            action: function(e, dt, node, config) {
                                window.location.href = "/admin/product/create";
                            }
                        },
                        {
                            text: '変更',
                            className: 'btn bg-teal-400',
                            action: function(e, dt, node, config) {
                                window.location.href = "/admin/product/create";
                            }
                        },
                        {
                            text: '削除',
                            className: 'btn bg-teal-400',
                            action: function(e, dt, node, config) {
                                window.location.href = "/admin/product/create";
                            }
                        },
                    ],
                    columns: [
                        {data:'information_title'},
                        {data:'information_kbn'},
                        {data:'keisai_ymd'},
                        {data:'enable_ymd'},
                    ],
                });

                $('.table input').not('.toggle-frozen').on('keyup change', function (event){
                    // if(event.keyCode == 13)
                    filterColumn($(this).parents('td').attr('data-column'));
                });

                function filterColumn ( i ) {
                    table.column( i ).search($('#col'+i+'_filter').val()).draw();
                }
            };

            // Select2 for length menu styling
            var _componentSelect2 = function() {
                if (!$().select2) {
                    console.warn('Warning - select2.min.js is not loaded.');
                    return;
                }

                // Initialize
                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: 'auto'
                });

                // Enable Select2 select for individual column searching
                $('.filter-select').select2();
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function() {
                    _componentDatatableAPI();
                    _componentSelect2();
                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            NotyJgrowl.init();
            DatatableCustomButtonWithSearch.init();
        });

        $(function(){

        });
    </script>
</head>

<!-- Page content -->
<div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content pt-0">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">お知らせ一覧</h5>
                </div>

                <div class="card-body">
                    <form action="#">
                        <fieldset class="mb-3">
                            <legend class="text-uppercase font-size-sm font-weight-bold">検索機能</legend>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">お知らせタイトル</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control">
                                </div>

                                <label class="col-form-label col-lg-2">お知らせ区分</label>
                                <div class="col-lg-2">
                                    <select class="form-control">
                                        <option>-</option>
                                        <option value="0">重要</option>
                                        <option value="1">情報</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">掲載日</label>
                                <div class="col-lg-2">
                                    <input class="form-control" type="date" name="date">
                                </div>

                                <label class="col-form-label col-lg-2">適用期間</label>
                                <div class="col-lg-2">
                                    <input class="form-control" type="date" name="date">
                                </div>
                                <label class="col-form-label">～</label>
                                <div class="col-lg-2">
                                    <input class="form-control" type="date" name="date">
                                </div>

                                <div class="col-lg-1 text-right">
                                    <button type="submit" class="btn btn-primary">検索</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                    <table class="table datatable-button-init-custom">
                        <thead>
                        <tr>
                            @php
                                foreach ($column_names as $key => $value){
                                    echo "<th>$value</th>";
                                }
                            @endphp
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /content area -->


        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						お知らせ設定
					</span>
            </div>
        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

<!-- modal loading -->
<div id="modal-loading" class="modal" tabindex='-1'>
    <div class="pace-demo bg-dark h-100 w-100">
        <div class="theme_tail theme_tail_circle">
            <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
            <div class="pace_activity"></div>
        </div>
    </div>
</div>
<!-- /modal loading -->
