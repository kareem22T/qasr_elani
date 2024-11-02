<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2023 &copy; <a href="" target="_blank" style="color: #000"></a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
{!! Html::script('back/assets/global/plugins/respond.min.js') !!}
{!! Html::script('back/assets/global/plugins/excanvas.min.js') !!}
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
{!! Html::script('back/assets/global/plugins/jquery.min.js') !!}
{!! Html::script('back/assets/global/plugins/jquery.validate.js') !!}
{!! Html::script('back/assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{{--{!! Html::script('back/assets/global/plugins/js.cookie.min.js') !!}--}}
{{--{!! Html::script('back/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}--}}
{!! Html::script('back/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{{--{!! Html::script('back/assets/global/plugins/jquery.blockui.min.js') !!}--}}
{!! Html::script('back/assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! Html::script('back/assets/pages/scripts/components-bootstrap-switch.min.js') !!}
{!! Html::script('back/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
{!! Html::script('back/assets/global/plugins/counterup/jquery.waypoints.min.js') !!}
{!! Html::script('back/assets/global/plugins/counterup/jquery.counterup.min.js') !!}
{!! Html::script('back/assets/global/plugins/morris/morris.min.js') !!}
{{-- File Input JS  --}}
{!! Html::script('back/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}

<!-- BEGIN THEME GLOBAL SCRIPTS -->
{!! Html::script('back/assets/global/scripts/app.min.js') !!}
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{!! Html::script('back/assets/pages/scripts/dashboard.min.js') !!}
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
{!! Html::script('back/assets/layouts/layout4/scripts/layout.min.js') !!}
{!! Html::script('back/assets/layouts/layout4/scripts/demo.min.js') !!}
{!! Html::script('back/assets/layouts/global/scripts/quick-sidebar.min.js') !!}
<!-- END THEME LAYOUT SCRIPTS -->

{!! Html::script('back/assets/global/plugins/selectize-master/js/selectize.js') !!}
{!! Html::script('back/assets/global/plugins/select2/js/select2.full.min.js') !!}
{!! Html::script('back/assets/global/plugins/jquery-validation/js/jquery.validate.js') !!}
{!! Html::script('back/assets/global/plugins/jquery-validation/js/additional-methods.min.js') !!}
{!! Html::script("back/assets/ckeditor/ckeditor.js") !!}
{!! Html::script("back/assets/global/plugins/ckeditor/ckeditor.js") !!}

{{-- START SECTION DATA TABLE --}}

{!! Html::script('back/datatable/global/plugins/datatables/media/js/jquery.dataTables.min.js') !!}
{!! Html::script('back/datatable/global/scripts/jqueryDatatable.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js') !!}
{!! Html::script('back/datatable/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
{!! Html::script('back/assets/global/sweetAlert/sweetalert.min.js') !!}

{{-- This File has function Sweet Alert [ Just include for imporve code  ] --}}
@include('admin.appJsBaldeSweetAlert') ;

{{-- END SECTION DATA TABLE --}}
<script>

    $(function () {
        // $('select').selectize({ create: true,});

        $('.select2').select2({
            tags: false,
            tokenSeparators: [','],
        });

    });
</script>

@yield('inlineJS')


</body>
</html>
