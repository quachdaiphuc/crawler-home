@extends('protected.admin.includes.layout')

@section('content')

<div class="content">
	
    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="?task=users&action=index">{!! trans('lable.user.list') !!}</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
        </ul>

    </div>

    <div class="workplace">
 
        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>{!! trans('lable.user.manage') !!}</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">


                    {!! Form::model($object, array('route' => array('admin.member.update', $object->id), 'method' => 'PUT', 'enctype'=>'multipart/form-data')) !!}
                    	<div class="row-form">
                            <div class="span3">Username:</div>
                            <div class="span9">
                            @if($errors->has('username'))
                                <span style="color: #c9302c;">{{ $errors->first('username') }}</span>
                            @endif
                            {!! Form::text('username') !!}
                            </div>
                            <div class="clear"></div>
                        </div> 

                    	<div class="row-form">
                            <div class="span3">Password:</div>
                            <div class="span9">
                            @if($errors->has('password'))
                                <span style="color: #c9302c;">{{ $errors->first('password') }}</span>
                            @endif
                            {!! Form::password('password', ['placeholder' => 'Nhập password nếu muốn thay đổi password.']) !!}
                            </div>
                            <div class="clear"></div>
                        </div>

                    	<div class="row-form">
                            <div class="span3">Upload Avatar:</div>
                            <div class="span9">
                            @if($errors->has('image'))
                                <span style="color: #c9302c;">{{ $errors->first('image') }}</span>
                            @endif
                            @if($object->image != '')
                                <img sytle="display: block; width: 20px; height:40px;" src="{{ asset($object->image) }}">
                            @endif
                            {!! Form::file('image')  !!}
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                            @if($errors->has('active'))
                                <span style="color: #c9302c;">{{ $errors->first('active') }}</span>
                            @endif
                                {!! Form::select('active', array('' => 'Select one' , '1' => 'Active', '0' => 'Deactive') ) !!}
                            </div>
                            <!--insert created at and updated-at code here -->
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" name="action" value="Save">Update</button>
							<div class="clear"></div>
                        </div>
                    {!! Form::close() !!}
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>
</div>
</body>
</html>
@stop