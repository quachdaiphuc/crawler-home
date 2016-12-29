<div id="{{$setting->name}}">
    <div  class="row marginTop10">
        <div class="col-md-4" style="margin-left: {{ 20 * $margin }}px">
            <div class="form-inline">
                {!! Form::select("tags[{$setting->name}]", $tags, $setting->tag,['class' => 'form-control'] ) !!}
                <input required = 'required' name="htmls[{{$setting->name}}]" value="{{$setting->html}}" type="text" class="form-control">
                <input type="hidden" name="depths[]" value="{{$setting->name}}">
            </div>
        </div>
        <div class="col-md-2 no-padding">
            <button onclick="add('{{$setting->name}}')" class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
            <button onclick="remove('{{$setting->name}}')" class="btn red margin0" type="button"><i class="fa fa-times"></i></button>
            <button onclick="selectField('{{$setting->name}}')" class="btn green margin0" type="button"><i class="fa fa-paper-plane-o"></i></button>
        </div>
        <div class="col-md-2">
            <label id="field-{{$setting->name}}" class="control-label col-md-1 col-sm-1 col-xs-12 text-left">
                {{ $setting->field }}
            </label>
            <input type="hidden" name="hid_fields[{{$setting->name}}]" value="{{$setting->field}}" id="hid-field-{{$setting->name}}">
        </div>
        <div class="col-md-2">
            {!! Form::select("types[{$setting->name}]", $types, $setting->type,['class' => 'form-control'] ) !!}
        </div>
    </div>
</div>
<!-- /.row -->