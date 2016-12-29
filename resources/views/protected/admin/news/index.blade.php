@extends('protected.admin.includes.layout')
{{--include extra css--}}
@section('outCSS')
    <link href="{{asset('assets/css/icheck/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/datatables/tools/css/dataTables.tableTools.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{trans('label.admin.news.title')}}<small>{{ trans('label.list') }}</small></h2>

                <div class="clearfix"></div>
            </div>
            @if(Session::has('success'))
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{Session::get('success')}}
            </div>
            @endif
            <div class="x_content">
                <table id="news" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>{{trans('label.admin.news.id')}}</th>
                                <th>{{trans('label.admin.news.title')}}</th>
                                <th>{{trans('label.admin.news.thumbnail')}}</th>
                                <th>{{trans('label.admin.news.detail')}}</th>
                                <th>{{trans('label.admin.news.created_at')}}</th>
                                <th class=" no-link last"><span class="nobr">{{trans('label.action')}}</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($viewData as $item)
                                <tr class="even pointer">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title}}</td>
                                    <td><img style="width: 100px; height: 120px;" src="{{ asset($item->thumbnail == '' ? 'assets/images/No_Image.png' : $item->thumbnail) }}" alt=""/></td>
                                    <td>{{ strlen($item->detail) > 100 ? substr($item->detail,0,100)."..." : $item->detail }}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>
                                    <a class="btn btn-danger" onclick="doAction('{{trans('message.MSG_DO_ACTION_DELETE')}}', {{ $item->id  }})">
                                       <i class="fa fa-times fa-x"></i>
                                    </a>
                                    </td>
                                 </tr>
                                @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    <br />
    <br />
    <br />

</div>

@stop

@section('outJS')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('assets/js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    <script src="{{asset('assets/js/admin/news.js')}}"></script>
@stop
