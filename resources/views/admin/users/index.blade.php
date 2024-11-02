@extends('admin.layout')
@section('title',trans('users.controlUsers'))
@section('content')
    <div>
        <a href="{{Url('/')}}/admin/users/create" class="btn blue btn-circle "><i
                class="fa fa-plus"></i> {!! trans('assets.AddNew') !!}</a>
    </div>
    <br>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="" href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item active"><a title=""
                                              href="{{ Url('/')}}/admin/users ">{!! trans('users.users') !!} </a></li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            @if(\App\Models\User::count() > 0)
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users"></i> {!! trans('users.controlUsers') !!}
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{!! trans('users.username') !!}</th>
                                <th>{!! trans('users.email') !!}</th>
                                <th>{!! trans('users.phone') !!}</th>
                                <th>{!! trans('users.add_date') !!}</th>
                                <th>{!! trans('users.active_status') !!}</th>
                                <th>{!! trans('users.control') !!}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            @else
                <div class="alert alert-info">{!! trans('assets.noData') !!}</div>
            @endif


        </div>
    </div>

@section('inlineJS')
    <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "order": [[0, 'desc']],
                "ajax": "{{Url('admin/users/dataTable')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'active', name: ''},
                    {data: 'control', name: ''}
                ], "language": {
                    url: "{{(Session::get('local') !== 'en') ? 'https://cdn.datatables.net/plug-ins/1.10.13/i18n/Arabic.json':''}}"
                },
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [6]}
                ],
            });
        });

        $(document).on('click', '[id^="delete-user-"]', function (e) {
            e.preventDefault();
            var $button = $(this);
            var id = this.id.split('-').pop();
            var myArray = shuffle(['#519e57', 'e85423', '#000', '#999']);
            $txt = '';
            $msg = "{{trans('sweet.msg') }}";
            $confMsg = "{{trans('sweet.confMsg')}}";

            $cancMsg = "{{trans('sweet.cancMsg')}}";
            <?php
            if (getSession() == 0) {
                $msg = '  تم الحذف بنجاح .';
            } else {
                $msg = '  Data Has Been Deleted Successfully .';
            }
            ?>

            swal({
                    title: $msg,
                    text: $txt,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: myArray[0], /*e85423*/
                    confirmButtonText: $confMsg,
                    cancelButtonText: $cancMsg,
                    closeOnConfirm: false,
                    animation: true
                },
                function () {
                    var table = $('#myTable').DataTable();
                    $.ajax({
                        type: 'get',
                        url: '{{Url('admin/users/delete')}}',
                        dataType: 'json',
                        data: {id: id},
                        success: function (result) {
                            swal("", "{{$msg}}");
                            if ("{{\App\Models\User::count() == 1}}"){
                                location.reload(true);
                            }else {
                                table.row($button.parents('tr')).remove().draw();
                            }
                        },
                        error: function (status) {
                            console.log(status);
                        }
                    });
                });


        });

        function shuffle(array) {
            let counter = array.length;

            // While there are elements in the array
            while (counter > 0) {
                // Pick a random index
                let index = Math.floor(Math.random() * counter);

                // Decrease counter by 1
                counter--;

                // And swap the last element with it
                let temp = array[counter];
                array[counter] = array[index];
                array[index] = temp;
            }

            return array;
        }
    </script>

@endsection

@endsection
