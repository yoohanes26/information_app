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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
    <script src="/global_assets/js/plugins/tables/datatables/extensions/select.min.js"></script>
{{--        <script src="https://cdn.datatables.net/v/bs5/dt-2.1.6/sl-2.1.0/datatables.min.js"></script>--}}
    {{--        <script src="/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>--}}
    <script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="/global_assets/js/plugins/forms/validation/validate.min.js"></script>
    <script src="/global_assets/js/plugins/forms/validation/additional_methods.min.js"></script>
    <script src="/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script src="/global_assets/js/demo_pages/colors_success.js"></script>
    <script src="/global_assets/js/demo_pages/colors_danger.js"></script>
    <script src="/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="/global_assets/js/plugins/forms/validation/validate.min.js"></script>
    <script src="/global_assets/js/plugins/forms/validation/additional_methods.min.js"></script>

    <script type="text/javascript">
        var FormValidation = function() {

            // Uniform
            var _componentUniform = function() {
                if (!$().uniform) {
                    console.warn('Warning - uniform.min.js is not loaded.');
                    return;
                }

                // Initialize
                $('.form-input-styled').uniform({
                    fileButtonClass: 'action btn bg-blue'
                });
            };

            // Validation config
            var _componentValidation = function() {
                if (!$().validate) {
                    console.warn('Warning - validate.min.js is not loaded.');
                    return;
                }

                jQuery.validator.addMethod("date_start_check_empty", function(value, element) {
                    // return this.optional(element) || (parseFloat(value) > 0);

                    $date_start = new Date($('#create_enable_start_ymd').val());
                    $date_end = new Date($('#create_enable_end_ymd').val());

                    return $date_start < $date_end;
                }, "終了日は開始日以降である必要があります。");

                jQuery.validator.addMethod("date_end_check", function(value, element) {
                    // return this.optional(element) || (parseFloat(value) > 0);

                    if($('#create_enable_start_ymd').val())
                        return true;
                    return false;
                }, "適用開始日が必須です。");


                // Initialize
                var validator_create_information = $('.form_create_information').validate({
                    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                    errorClass: 'validation-invalid-label',
                    successClass: 'validation-valid-label',
                    validClass: 'validation-valid-label',
                    highlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    success: function(label) {
                        label.addClass('validation-valid-label').text('入力は正しい。'); // remove to hide Success message
                    },

                    // Different components require proper error label placement
                    errorPlacement: function(error, element) {

                        // Unstyled checkboxes, radios
                        if (element.parents().hasClass('form-check')) {
                            error.appendTo( element.parents('.form-check').parent() );
                        }

                        // Input with icons and Select2
                        else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                            error.appendTo( element.parent() );
                        }

                        // Input group, styled file input
                        else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                            error.appendTo( element.parent().parent() );
                        }

                        // Other elements
                        else {
                            error.insertAfter(element);
                        }
                    },
                    rules: {
                        enable_end_ymd: {
                            date_end_check: true,
                            date_start_check_empty: true,
                        },
                    },
                    messages: {
                        information_title: {
                            required: 'このフィールドは必須です。'
                        },
                        keisai_ymd: {
                            required: 'このフィールドは必須です。'
                        },
                        enable_start_ymd: {
                            required: 'このフィールドは必須です。'
                        },
                        enable_end_ymd: {
                            required: 'このフィールドは必須です。'
                        },
                        information_naiyo: {
                            required: 'このフィールドは必須です。'
                        },
                    }
                });

                jQuery.validator.addMethod("date_start_check_empty", function(value, element) {
                    // return this.optional(element) || (parseFloat(value) > 0);

                    $date_start = new Date($('#enable_start_ymd_update_form').val());
                    $date_end = new Date($('#enable_end_ymd_update_form').val());

                    return $date_start < $date_end;
                }, "終了日は開始日以降である必要があります。");

                jQuery.validator.addMethod("date_end_check", function(value, element) {
                    // return this.optional(element) || (parseFloat(value) > 0);

                    if($('#enable_start_ymd_update_form').val())
                        return true;
                    return false;
                }, "適用開始日が必須です。");

                var validator_update_information = $('.form_update_information').validate({
                    ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                    errorClass: 'validation-invalid-label',
                    successClass: 'validation-valid-label',
                    validClass: 'validation-valid-label',
                    highlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    unhighlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    },
                    success: function(label) {
                        label.addClass('validation-valid-label').text('入力は正しい。'); // remove to hide Success message
                    },

                    // Different components require proper error label placement
                    errorPlacement: function(error, element) {

                        // Unstyled checkboxes, radios
                        if (element.parents().hasClass('form-check')) {
                            error.appendTo( element.parents('.form-check').parent() );
                        }

                        // Input with icons and Select2
                        else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                            error.appendTo( element.parent() );
                        }

                        // Input group, styled file input
                        else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                            error.appendTo( element.parent().parent() );
                        }

                        // Other elements
                        else {
                            error.insertAfter(element);
                        }
                    },
                    rules: {
                        enable_end_ymd: {
                            date_end_check: true,
                            date_start_check_empty: true,
                        },
                    },
                    messages: {
                        information_title: {
                            required: 'このフィールドは必須です。'
                        },
                        keisai_ymd: {
                            required: 'このフィールドは必須です。'
                        },
                        enable_start_ymd: {
                            required: 'このフィールドは必須です。'
                        },
                        enable_end_ymd: {
                            required: 'このフィールドは必須です。'
                        },
                        information_naiyo: {
                            required: 'このフィールドは必須です。'
                        },
                    }
                });
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function() {
                    _componentUniform();
                    _componentValidation();
                }
            }
        }();

        // DataTablesのファンクション
        var DatatableCustomButtonWithSearch = function() {
            var _componentDatatableAPI = function() {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }

                // DataTablesデフォルト設定
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>フィルター:</span> _INPUT_',
                        searchPlaceholder: 'フィルターを入力...',
                        lengthMenu: '<span>Show:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                    }
                });

                // DataTablesのプロパティを定義
                var table = $('.datatable-button-init-custom').DataTable({
                    // language: {
                    //     url: '//cdn.datatables.net/plug-ins/2.1.5/i18n/ja.json',
                    // },
                    order: [0, "asc"],
                    processing: true,
                    serverSide: true,
                    ajax: "/information",
                    pageLength: 100,
                    // scrollCollapse: true,
                    scrollY: '500px',
                    select: {
                        style: 'single'
                    },
                    columns: [
                        {data:'information_title'},
                        {data:'information_kbn_text'},
                        {data:'keisai_ymd'},
                        {data:'enable_ymd'},
                    ],
                });

                // お知らせ項目が選択された時に「変更」と「削除」ボタンを有効
                table.on('select.dt', function () {
                    // console.log(table.rows({selected:true}).data()[0].information_id);
                    $('#btn-update-info').removeClass('disabled');
                    $('#btn-delete-info').removeClass('disabled');
                    $('#btn-detail-info').removeClass('disabled');
                    $('#btn-update-info').attr('disabled', false);
                    $('#btn-delete-info').attr('disabled', false);
                    $('#btn-detail-info').attr('disabled', false);
                });

                // お知らせ項目が選択が外された時に「変更」と「削除」ボタンを無効
                table.on('deselect.dt', function () {
                    $('#btn-update-info').addClass('disabled');
                    $('#btn-delete-info').addClass('disabled');
                    $('#btn-detail-info').addClass('disabled');
                    $('#btn-update-info').attr('disabled', true);
                    $('#btn-delete-info').attr('disabled', true);
                    $('#btn-detail-info').attr('disabled', true);
                });
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


        // モジュール初期化
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            DatatableCustomButtonWithSearch.init();
            FormValidation.init();
        });

        $(function(){
            $('#btn-create-info').click(function(){
                // フィールドを初期化
                $('#form_create_information')[0].reset();

                // アラートなどを削除
                $('#form_create_information .validation-invalid-label').remove();

                // モーダルを表示
                $('#modal-create').modal();
            });

            $('#btn-update-info').click(function(){
                table = $('.datatable-button-init-custom').DataTable();

                // フィールドを選択された項目の内容に初期化
                $('#information_id_update_form').val(table.rows({selected:true}).data()[0].information_id);
                $('#information_title_update_form').val(table.rows({selected:true}).data()[0].information_title);
                $('#information_kbn_update_form').val(table.rows({selected:true}).data()[0].information_kbn);
                $('#keisai_ymd_update_form').val(formatDate(table.rows({selected:true}).data()[0].keisai_ymd));
                $('#enable_start_ymd_update_form').val(formatDate(table.rows({selected:true}).data()[0].enable_start_ymd));
                $('#enable_end_ymd_update_form').val(formatDate(table.rows({selected:true}).data()[0].enable_end_ymd));
                $('#information_naiyo_update_form').val(table.rows({selected:true}).data()[0].information_naiyo);

                // アラートなどを削除
                $('#form-update-information .validation-invalid-label').remove();

                // モーダルを表示
                $('#modal-update').modal();
            });

            $('#btn-delete-info').click(function(){
                $('#information_id_delete_form').val($('.datatable-button-init-custom').DataTable().rows({selected:true}).data()[0].information_id);
                $('#modal-delete').modal();
            });

            $('#btn-detail-info').click(function(){
                table = $('.datatable-button-init-custom').DataTable();

                enable_ymd = formatDate(table.rows({selected:true}).data()[0].enable_start_ymd) + ' ～ ' + formatDate(table.rows({selected:true}).data()[0].enable_end_ymd);

                // フィールドを選択された項目の内容に初期化
                $('#information_title_detail').html(table.rows({selected:true}).data()[0].information_title);
                $('#information_kbn_detail').html(table.rows({selected:true}).data()[0].information_kbn);
                $('#keisai_ymd_detail').html(formatDate(table.rows({selected:true}).data()[0].keisai_ymd));
                $('#enable_ymd_detail').html(enable_ymd);
                $('#information_naiyo_detail').html(table.rows({selected:true}).data()[0].information_naiyo);

                // アラートなどを削除
                $('#form-update-information .validation-invalid-label').remove();

                // モーダルを表示
                $('#modal-detail').modal();
            });

            function formatDate(date) {
                var d = new Date(date);

                month = '' + (d.getMonth() + 1);
                day = '' + d.getDate();
                year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            function formatDateDisplay(date) {
                var d = new Date(date);

                month = '' + (d.getMonth() + 1);
                day = '' + d.getDate();
                year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('/');
            }

            $('#form_information_search').submit(function(e){
                e.preventDefault();

                table = $('.datatable-button-init-custom').DataTable();
                // table = new DataTable('.datatable-button-init-custom');

                table.columns(0).search($('#information_title_search').val());

                var kbn;

                switch ($('#information_kbn_search').val()){
                    case '0':
                        kbn = '重要'
                        break;
                    case '1':
                        kbn = '情報'
                        break;
                    default:
                        kbn = ''
                        break;
                }

                table.columns(1).search(kbn);

                keisai_ymd = '';
                if($('#information_keisai_ymd_search').val())
                    keisai_ymd = formatDateDisplay($('#information_keisai_ymd_search').val());

                table.columns(2).search(keisai_ymd);

                enable_ymd = '';

                if($('#information_enable_start_ymd_search').val())
                    enable_ymd += formatDateDisplay($('#information_enable_start_ymd_search').val());

                enable_ymd += ' ～ ';

                if($('#information_enable_end_ymd_search').val())
                    enable_ymd += formatDateDisplay($('#information_enable_end_ymd_search').val());

                table.columns(3).search(enable_ymd);

                // table.search.fixed('range', function (searchStr, data, index) {
                //     date_start_search = new Date($('#information_enable_start_ymd_search').val());
                //     date_end_search = new Date($('#information_enable_end_ymd_search').val());
                //
                //     dates = data[3];
                //
                //     dates = value.split(' ～ ');
                //
                //     date_start = new Date(dates[0]);
                //     date_end = new Date(dates[1]);
                //
                //     if(search_date_start && !search_date_end){
                //         if(date_start >= search_date_start || date_end >= search_date_start ){
                //             console.log("true. date_start: " + date_start + ' date_end: ' + date_end);
                //             return true;
                //         }
                //     } else if (!search_date_start && search_date_end){
                //         if(date_start <= search_date_start || date_end <= search_date_start ){
                //             console.log("true. date_start: " + date_start + ' date_end: ' + date_end);
                //             return true;
                //         }
                //     } else if(search_date_start && search_date_end){
                //
                //     } else {
                //         return true;
                //     }
                //     console.log("false. date_start: " + date_start + ' date_end: ' + date_end);
                //     return false;
                // });

                // table.column(3).data().filter(function(value, index){
                //     search_date_start = $('#information_enable_start_ymd_search').val();
                //     search_date_end = $('#information_enable_end_ymd_search').val();
                //
                //     dates = value.split(' ～ ');
                //
                //     date_start = dates[0];
                //     date_end = dates[1];
                //
                //     if(search_date_start && !search_date_end){
                //         if(new Date(date_start) >= new Date(search_date_start) || new Date(date_end) >= new Date(search_date_start) ){
                //             console.log("true. date_start: " + date_start + ' date_end: ' + date_end);
                //             return true;
                //         }
                //     } else if (!search_date_start && search_date_end){
                //         if(new Date(date_start) <= new Date(search_date_start) || new Date(date_end) <= new Date(search_date_start) ){
                //             console.log("true. date_start: " + date_start + ' date_end: ' + date_end);
                //             return true;
                //         }
                //     } else if(search_date_start && search_date_end){
                //
                //     } else {
                //         return true;
                //     }
                //     console.log("false. date_start: " + date_start + ' date_end: ' + date_end);
                //     return false;
                // });

                table.draw();
            });

            $('#btn-reset-search').click(function(){
                table = $('.datatable-button-init-custom').DataTable();

                $('#information_title_search').val('');

                $('#information_kbn_search option').removeAttr('selected');
                $('#information_kbn_search option[value="2"]').attr('selected', 'selected');

                $('#information_keisai_ymd_search').val('');
                $('#information_enable_start_ymd_search').val('');
                $('#information_enable_end_ymd_search').val('')

                table.draw();
            });
        });
    </script>
</head>

<!-- Main content -->
<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><span class="font-weight-semibold">お知らせ一覧</span></h4>
            </div>
        </div>
        @if(null !== Session::get('successMessage'))
            <div class="page-header-content">
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{Session::get('successMessage')}}
                </div>
            </div>
        @endif
        @if(null !== Session::get('errorMessage'))
            <div class="page-header-content">
                <div class="alert alert-danger alert-styled-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{Session::get('errorMessage')}}
                </div>
            </div>
        @endif
    </div>
    <!-- /page header -->
    <!-- ページコンテンツ -->
    <div class="page-content">
        <!-- メインコンテンツ -->
        <div class="content-wrapper">

            <!-- コンテンツエリア -->
            <div class="content pt-0">
                <div class="card">
                    <div class="card-body">
                        <form action="#" id="form_information_search">
                            <fieldset class="mb-3">
                                <legend class="text-uppercase font-size-sm font-weight-bold">検索機能</legend>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">お知らせタイトル</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" name="information_title_search" id="information_title_search" placeholder="お知らせタイトル">
                                    </div>

                                    <label class="col-form-label col-lg-2">お知らせ区分</label>
                                    <div class="col-lg-2">
                                        <select class="form-control" name="information_kbn_search" id="information_kbn_search">
                                            <option value="2" selected>-</option>
                                            <option value="0">重要</option>
                                            <option value="1">情報</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2">掲載日</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" type="date" name="keisai_ymd" id="information_keisai_ymd_search">
                                    </div>

                                    <label class="col-form-label col-lg-2">適用期間</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" type="date" name="enable_start_ymd" id="information_enable_start_ymd_search">
                                    </div>
                                    <label class="col-form-label">～</label>
                                    <div class="col-lg-2">
                                        <input class="form-control" type="date" name="enable_end_ymd" id="information_enable_end_ymd_search">
                                    </div>

                                    <div class="col-lg-1 text-right">
                                        <button type="submit" class="btn btn-primary">検索</button>
                                        <button class="btn btn-danger" id="btn-reset-search">リセット</button>
                                    </div>
{{--                                    <div class="col-lg-1 text-right">--}}
{{--                                    </div>--}}
                                </div>
                            </fieldset>
                        </form>

                        <table class="table datatable-button-init-custom" id="datatable-information">
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

                        <div class="form-group row">
                            <button class="col-lg-1 btn bg-primary btn-labeled" id="btn-create-info">登録</button>
                            <div class="col-lg-2"></div>
                            <button class="col-lg-1 btn bg-teal-400 btn-labeled disabled" id="btn-update-info" disabled>変更</button>
                            <div class="col-lg-2"></div>
                            <button class="col-lg-1 btn bg-danger btn-labeled disabled" id="btn-delete-info" disabled>削除</button>
                            <div class="col-lg-2"></div>
                            <button class="col-lg-1 btn bg-info btn-labeled disabled" id="btn-detail-info" disabled>詳細</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /コンテンツエリア -->




        </div>
        <!-- /メインコンテンツ -->
    </div>
    <!-- /ページコンテンツ -->
    <!-- フッター -->
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            お知らせ設定
                        </span>
        </div>
    </div>
    <!-- /フッター -->
</div>
<!-- /main content -->

<!-- ロードモーダル -->
<div id="modal-loading" class="modal" tabindex='-1'>
    <div class="pace-demo bg-dark h-100 w-100">
        <div class="theme_tail theme_tail_circle">
            <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
            <div class="pace_activity"></div>
        </div>
    </div>
</div>
<!-- /ロードモーダル -->

<!-- 登録フォームのモーダル -->
<div id="modal-create" class="modal fade" tabindex='-1'>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h5 class="modal-title">お知らせ新規登録</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <hr>

            <form action="/information" method="POST" id="form_create_information" class="form-horizontal form_create_information">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせタイトル <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="information_title" class="form-control" required placeholder="お知らせタイトル">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせ区分 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select class="form-control" name="information_kbn">
                                <option value="0">重要</option>
                                <option value="1">情報</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">掲載日 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="date" name="keisai_ymd" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">適用期間 <span class="text-danger">*</span></label>
                        <div class="col-lg-4">
                            <input type="date" name="enable_start_ymd" id="create_enable_start_ymd" class="form-control" required>
                        </div>
                        <div class="col-lg-1 center">
                            <label class="col-form-label">～</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="date" name="enable_end_ymd" id="create_enable_end_ymd" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせ内容 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <textarea rows="3" cols="3" name="information_naiyo" class="form-control" placeholder="お知らせ内容" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-link" data-dismiss="modal">閉じる</button>
                        <button type="submit" id="submit-add-admin" class="btn btn-primary">登録</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /登録フォームのモーダル -->

<!-- 変更フォームのモーダル -->
<div id="modal-update" class="modal fade" tabindex='-1'>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h5 class="modal-title">お知らせ変更</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <hr>

            <form action="/information/edit" method="POST" id="form_update_information" class="form-horizontal form_update_information">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="information_id" id="information_id_update_form">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせタイトル <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="information_title" class="form-control" id="information_title_update_form" required placeholder="お知らせタイトル">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせ区分 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select class="form-control" name="information_kbn" id="information_kbn_update_form">
                                <option value="0">重要</option>
                                <option value="1">情報</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">掲載日 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="date" name="keisai_ymd" class="form-control" id="keisai_ymd_update_form" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">適用期間 <span class="text-danger">*</span></label>
                        <div class="col-lg-4">
                            <input type="date" name="enable_start_ymd" class="form-control" id="enable_start_ymd_update_form" required>
                        </div>
                        <div class="col-lg-1 center">
                            <label class="col-form-label">～</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="date" name="enable_end_ymd" class="form-control" id="enable_end_ymd_update_form" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせ内容 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <textarea rows="3" cols="3" name="information_naiyo" class="form-control" id="information_naiyo_update_form" placeholder="お知らせ内容" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="text-right">
                        <button type="button" class="btn btn-link" data-dismiss="modal">閉じる</button>
                        <button type="submit" id="submit-add-admin" class="btn btn-primary">変更</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /変更フォームのモーダル -->

<!-- 削除警告のモーダル -->
<div id="modal-delete" class="modal fade align-content-center" tabindex='-1'>
    <div class='modal-dialog modal-xs center'>
        <div class='modal-content'>
            <div class='modal-body'>
                <h3 class="d-flex justify-content-center" style="margin: auto; padding-bottom: 10%">削除してもよろしいですか?</h3>
                <div class="text-right">
                    <form action="/information/delete" id="form_delete_information" method="POST">
                        @csrf

                        <input type="hidden" id="information_id_delete_form" name="information_id">

                        <div class="text-right">
                            <button type='button' class='btn btn-link' data-dismiss='modal'>いいえ</button>
                            <button type="submit" class="btn btn-danger">はい</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /削除警告のモーダル -->

<!-- お知らせ詳細のモーダル -->
<div id="modal-detail" class="modal fade" tabindex='-1'>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h5 class="modal-title">お知らせ詳細</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <hr>

            <div class="modal-body">
                <input type="hidden" name="information_id" id="information_id_update_form">
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 font-weight-bold">お知らせタイトル</label>
                    <label class="col-form-label col-lg-9" id="information_title_detail"></label>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 font-weight-bold">お知らせ区分</label>
                    <label class="col-form-label col-lg-9" id="information_kbn_detail"></label>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 font-weight-bold">掲載日</label>
                    <label class="col-form-label col-lg-9" id="keisai_ymd_detail"></label>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 font-weight-bold">適用期間</label>
                    <label class="col-form-label col-lg-9" id="enable_ymd_detail"></label>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3 font-weight-bold">お知らせ内容</label>
                    <label class="col-form-label col-lg-9" id="information_naiyo_detail"></label>
                </div>
            </div>

            <div class="modal-footer">
                <div class="text-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /お知らせ詳細のモーダル -->
