@extends('protected.admin.includes.layout')
@section('content')
<div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{trans('label.admin.tool.title')}}<small>{{trans('label.create')}}</small></h2>

                        <div class="clearfix"></div>
                    </div>

                    <div id="mes-alert-success" style="display: none;" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p id="mes-success"></p>
                    </div>
                    <div id="mes-alert-error" style="display: none;" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p id="mes-error"></p>
                    </div>

                    <div class="x_content">
                        {!! Form::open(['route' => 'admin.tool.store', 'method' => 'POST', 'class' => 'form-horizontal form-label-left','id' => 'form-setting', 'files' => 'true']) !!}
                            <p>All field has <code>*</code> is require
                            </p>
                            <span class="section"></span>

                            <div class="item form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last_name">Table<code>*</code>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('tables', $tables, null,['id' => 'selectTable', 'class' => 'form-control'] ) !!}
                                </div>

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last_name">Setting Name
                                </label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <span for="" id="mes-duplicate" class="red"></span>
                                    {!! Form::text('sName', null, [
                                    'placeholder' => '',
                                    'id' => 'setting-name',
                                    'onblur' => 'checkDuplicate(this.value)',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    ])!!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">URL<code>*</code>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('url', null, [
                                    'placeholder' => '',
                                    'id' => 'url',
                                    'placeholder' => 'https://codecanyon.net/',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Setting
                                </label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    {!! Form::select('setting', $settings, null,['id' => 'select-setting', 'class' => 'form-control'] ) !!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <p><b>Setting HTML tag</b></p>
                            <span class="section"></span>

                            <div id="setting-html-row">
                                <div id="0">
                                    <div class="row marginTop10">
                                        <div class="col-md-4">
                                            <div class="form-inline">
                                                {!! Form::select('tags[0]', $tags, null,['class' => 'form-control'] ) !!}
                                                <input name="htmls[0]" type="text" class="form-control" placeholder='Ex: class="news-list"'>
                                                <input type="hidden" name="depths[]" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-2 no-padding">
                                            <button onclick="add('0')" class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button onclick="save_setting()" type="button" class="btn btn-success" id="btn-save-setting" disabled="disabled">Save Setting</button>
                                    {!! Form::submit('Crawl', ['class' => 'btn btn-primary', 'id' => 'send']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Small modal -->
    <div class="modal fade bs-example-modal-sm" id="modalSelectField" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <input type="hidden" id="hidID">
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last_name">Field
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12" id="selectFieldBox">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button onclick="selectedField()" type="button" class="btn btn-primary">Select item</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Large modal -->

    @if(Session::has('viewData'))
    <div class="modal fade bs-example-modal-lg" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Preview</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            @if(Session::get('viewData') != 0)
                                <table id="result" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                    <tr class="headings">
                                        @foreach (Session::get('keys') as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach (Session::get('viewData') as $item)
                                        <tr class="even pointer">
                                            @foreach (Session::get('keys') as $key)
                                                <th>{{ $item[$key][0] }}</th>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p>No result crawled, please check your setting !</p>
                                </div>
                            @endif

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    @if(Session::get('viewData') != 0)
                        <button onclick="saveData()" type="button" class="btn btn-primary">Save Data</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
@stop

@section('outJS')
    <script src="{{ asset('assets/js/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('assets/js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    {{--<script src="{{asset('assets/js/validator/validator.js')}}"></script>--}}
    <script>
        var datas = '{{ Session::has('viewData')}}';
        console.log(datas);
        if(datas) {
            $('#modalPreview').modal('show');
        }
    </script>
    <script src="{{asset('assets/js/admin/tool-crawler.js')}}"></script>

@stop