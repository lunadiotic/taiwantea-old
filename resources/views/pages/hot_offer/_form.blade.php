<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    {!! Form::label('image', 'Image') !!}
    <div class="input-group">
      {!! Form::text('image', null, ['id' => 'thumbnail', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
      <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-default">
          <i class="fa fa-cloud-upload"></i> Choose
        </a>
      </span>
    </div>
    @if (isset($hot_offer) && $hot_offer->image !== '')
      <img src="{{ url('/') }}/{{ $hot_offer->image }}" id="holder" style="margin-top:15px;max-height:254px;max-width: 152px;">
    @endif
    <img id="holder" style="margin-top:15px;max-height:254px;max-width: 152px;">
    <small class="text-danger">{{ $errors->first('image') }}</small>
</div>

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status',['1' => 'Show', '0' => 'Hide'], null, ['id' => 'status', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('status') }}</small>
</div>

<div class="form-group text-right m-b-0">
  <a href="{{ empty($bread['0']) ? '#' : $bread['0']  }}" class="btn btn-white waves-effect waves-light m-l-5">
    Cancel
  </a>
  <button class="btn btn-primary waves-effect waves-light" type="submit">
    Submit
  </button>
</div>
