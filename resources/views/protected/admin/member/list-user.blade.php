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
                <h2>Member management <small>List</small></h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if(Session::has('success'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          {{Session::get('success')}}
                    </div>
                @endif
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">

                                <th>ID </th>
                                <th>Email </th>
                                <th>First Name </th>
                                <th>Last Name </th>
                                <th class=" no-link last"><span class="nobr">Action</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr class="even pointer">

                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->email }}<br>
                                    </td>
                                    <td>{{ $user->first_name}}</td>
                                    <td>{{ $user->last_name}}</td>
                                    <td>
                                    <a href="{{route('admin.member.edit', array('id' => $user->id ))}}">
                                       <i class="fa fa-pencil-square-o fa-2x"></i>
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

    <a href="{{route('admin.member.create')}}" class="btn btn-app">
        <i class="fa fa-plus"></i> Add
    </a>

</div>

@stop

@section('outJS')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('assets/js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('input.tableflat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });

        var asInitVals = new Array();
        $(document).ready(function () {
            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [-1, 0]
                    } //disables sorting for column one
        ],
                'iDisplayLength': 12,
                "sPaginationType": "full_numbers"
            });

        });

    </script>
@stop
