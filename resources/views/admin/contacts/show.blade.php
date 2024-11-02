@extends('admin.layout')
@section('title' , trans('contacts.title'))
@section('content')
    <style>
        .bg-info {
            background-color: #eee;
            padding: 10px;
            border-radius: 5px !important;
            border: 1px solid #ddd;
        }
    </style>
    <ol class="breadcrumb">

        <li class="breadcrumb-item"><a title="{!! trans('assets.home') !!}"
                                       href="{{ Url('/') }}/admin">{!! trans('assets.home') !!} /</a></li>
        <li class="breadcrumb-item"><a title="{!! trans('contacts.title') !!}"
                                       href="{{ Url('/')}}/admin/contacts "> {!! trans('contacts.title') !!} </a></li>
        <li class="breadcrumb-item active"> / {!! trans('contacts.showContact') !!} : {{ '#'.$contact->id }}</li>

    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><i class="fa fa-ticket"
                                                          aria-hidden="true"></i> {!! trans('contacts.showContact') !!}
                    : {{ '#'.$contact->id }}  </div>
                <div class="panel-body">
                    <div class="">
                        <div class="row">
                            <div class="col-md-10 profile-info">
                                <ul class="list-inline">
                                    <li>
                                        <i class="fa fa-user"></i>
                                        {!! trans('contacts.name') !!}
                                        {{ $contact->name }}
                                    </li>
                                    @if($contact->email != null)
                                        <br>
                                        <li>
                                            <i class="fa fa-envelope-o"></i>
                                            {!! trans('contacts.email') !!}
                                            {{ $contact->email }}
                                        </li>
                                    @endif
                                    <br>
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        {!! trans('users.phone_num') !!}
                                        {{ $contact->phone }}
                                    </li>
                                    <br>
                                    <li>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        {!! trans('contacts.add_date') !!}
                                        {{ $contact->created_at}}

                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                @if($contact->status == 0)
                                    <a href="{{url('/admin/contacts/' . $contact->id . '/changeStatus')}}"
                                       class="btn btn-danger btn-block"> <i class="fa fa-times"
                                                                            aria-hidden="true"></i> {{trans('contacts.open')}}
                                    </a>
                                @else
                                    <a href="{{url('/admin/contacts/' . $contact->id . '/changeStatus')}}"
                                       class="btn btn-success btn-block"> <i
                                            class="fa fa-check"></i>{{trans('contacts.closed')}}</a>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-info blockquote">
                                    <h4 class=""> {{$contact->message }}</h4>
                                </div>
                            </div>

                        </div>

                    </div>
                    <hr>

                    {!! Form::model($contact,['method' => 'post','action' => ['App\Http\Controllers\Dashboard\ContactsCtrl@addNotes',$contact->id], 'class' => 'form-horizontal']) !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label">{!! trans('contacts.notes') !!}</label>
                        <div class="col-md-8">
                            {!! Form::textarea('notes',null,['rows'=> 10,'class'=>'form-control','required', 'id' => 'notes'])!!}
                        </div>
                    </div>

                    <div class="row" id="actions">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-check"></i>
                                        {!! trans('assets.save') !!}
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{url('/admin/contacts')}}" class="btn btn-danger btn-block">
                                        {!! trans('assets.cancel') !!}
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('inlineJS')
    <script>

        $(document).ready(function () {
            if ("{{$contact->status == 1}}") {
                $('#notes').attr('disabled', 'disabled');
                $("#actions").hide();
            }
        });

    </script>

@endsection
