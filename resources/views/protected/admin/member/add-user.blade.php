@extends('protected.admin.includes.layout')

@section('content')
<div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Member management<small>Add</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        {!! Form::model($object, array('route' => $object->id != '' ? array('admin.member.update', $object->id) : 'admin.member.store', 'method' => $object->id != '' ? 'PUT' : 'POST', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal form-label-left')) !!}
                            <p>All field has <code>*</code> is require
                            </p>
                            <span class="section">Member info</span>



                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('first_name', $object->first_name, [
                                    'placeholder' => 'both name(s) e.g Jon Doe',
                                    'id' => 'first_name',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Last name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('last_name', $object->last_name, [
                                    'placeholder' => 'both name(s) e.g Jon Doe',
                                    'id' => 'last_name',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::email('email', $object->email, [
                                    'placeholder' => 'e.g join@gmail.com',
                                    'id' => 'email',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}

                                    {!! errors_for('email', $errors) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::password('password', [
                                    'placeholder' => 'Password',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'id' => 'password',
                                    'data-validate-length' => '6,8',
                                    ])!!}

                                    {!! errors_for('password', $errors) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::password('password_confirmation', [
                                    'placeholder' => 'Repeat Password',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'id' => 'password_confirmation',
                                    'data-validate-linked' => 'password',
                                    ])!!}
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    {!! Form::submit('Submit', ['class' => 'btn btn-success', 'id' => 'send']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('outJS')
    <!-- form validation -->
    <script src="{{asset('assets/js/validator/validator.js')}}"></script>
    <script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>
@stop