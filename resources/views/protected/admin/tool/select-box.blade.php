<select name="field" id="selectField" class="form-control">
    @foreach($fields as $field)
        <option value="{{$field}}">
            {{$field}}
        </option>
        @endforeach
</select>