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

                // Initialize
                var validator_create_admin = $('.form-create-department').validate({
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
                        label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
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
                        password: {
                            pattern: /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/
                        },
                        password_confirmation: {
                            equalTo: '#password_create_admin'
                        },
                        email: {
                            email: true,
                            remote: {
                                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                                url: '/admins/check_email_dupe',
                                type: 'post',
                            }
                        },
                    },
                    messages: {
                        password: {
                            pattern: 'Password must contain at least one upper-case letter, one lower-case letter, one number, one special character, and length at least 8.'
                        }
                    }
                });


                var validator_change_password = $('.form-change-password').validate({
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
                        label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
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
                        password: {
                            pattern: /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$/
                        },
                        password_confirmation: {
                            equalTo: '#password_field'
                        },
                    },
                    messages: {
                        password: {
                            pattern: 'Password must contain at least one upper-case letter, one lower-case letter, one number, one special character, and length at least 8.'
                        }
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
                    language: {
                        url: '//cdn.datatables.net/plug-ins/2.1.5/i18n/ja.json',
                    },
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
                    $('#btn-update-info').attr('disabled', false);
                    $('#btn-delete-info').attr('disabled', false);
                });

                // お知らせ項目が選択が外された時に「変更」と「削除」ボタンを無効
                table.on('deselect.dt', function () {
                    $('#btn-update-info').addClass('disabled');
                    $('#btn-delete-info').addClass('disabled');
                    $('#btn-update-info').attr('disabled', true);
                    $('#btn-delete-info').attr('disabled', true);
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


        // モジュール初期化
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            NotyJgrowl.init();
            DatatableCustomButtonWithSearch.init();
            FormValidation.init();
        });

        $(function(){
            $('#btn-create-info').click(function(){
                $('#form-create-information')[0].reset();
                $('#modal-create').modal();
            });

            $('#btn-update-info').click(function(){
                table = $('.datatable-button-init-custom').DataTable();

                $('#information_id_update_form').val(table.rows({selected:true}).data()[0].information_id);
                $('#information_title_update_form').val(table.rows({selected:true}).data()[0].information_title);
                $('#information_kbn_update_form').val(table.rows({selected:true}).data()[0].information_kbn);
                $('#keisai_ymd_update_form').val(formatDate(table.rows({selected:true}).data()[0].keisai_ymd));
                $('#enable_start_ymd_update_form').val(formatDate(table.rows({selected:true}).data()[0].enable_start_ymd));
                $('#enable_end_ymd_update_form').val(formatDate(table.rows({selected:true}).data()[0].enable_end_ymd));
                $('#information_naiyo_update_form').val(table.rows({selected:true}).data()[0].information_naiyo);
;
                $('#modal-update').modal();
            });

            $('#btn-delete-info').click(function(){
                $('#modal-delete').modal();
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
        });
    </script>
</head>

<!-- ページコンテンツ -->
<div class="page-content">
    <!-- メインコンテンツ -->
    <div class="content-wrapper">

        <!-- コンテンツエリア -->
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

                    <div class="form-group row">
                        <button class="col-lg-1 btn bg-primary btn-labeled" id="btn-create-info">登録</button>
                        <div class="col-lg-2"></div>
                        <button class="col-lg-1 btn bg-teal-400 btn-labeled disabled" id="btn-update-info" disabled>変更</button>
                        <div class="col-lg-2"></div>
                        <button class="col-lg-1 btn bg-danger btn-labeled disabled" id="btn-delete-info" disabled>削除</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /コンテンツエリア -->


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
    <!-- /メインコンテンツ -->

</div>
<!-- /ページコンテンツ -->

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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h5 class="modal-title">お知らせ新規登録</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <hr>

            <form action="" method="POST" id="form-create-information" class="form-horizontal">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_department" id="id_department">
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
                            <input type="date" name="enable_start_ymd" class="form-control" required>
                        </div>
                        <div class="col-lg-1 center">
                            <label class="col-form-label">～</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="date" name="enable_end_ymd" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3">お知らせ内容 <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <textarea rows="3" cols="3" name="information_naiyo" class="form-control" placeholder="お知らせ内容"></textarea>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h5 class="modal-title">お知らせ変更</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <hr>

            <form action="" method="POST" id="form-update-information" class="form-horizontal">
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
                            <textarea rows="3" cols="3" name="information_naiyo" class="form-control" id="information_naiyo_update_form" placeholder="お知らせ内容"></textarea>
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
<div id="modal-delete" class="modal fade" tabindex='-1'>
    <div class="pace-demo bg-dark h-100 w-100">
        <div class="theme_tail theme_tail_circle">
            <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
            <div class="pace_activity"></div>
        </div>
    </div>
</div>
<!-- /削除警告のモーダル -->
