<div class="btn-group" data-toggle="buttons">
    @foreach($options as $option => $label)
        <label class="btn btn-default btn-sm {{ \Request::get('location', 'all') == $option ? 'active' : '' }}">
            <input type="radio" class="nks-location" value="{{ $option }}">{{$label}}
        </label>
    @endforeach
</div>
