<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'required' => 'required', 'readonly']) !!}
    <small class="text-danger">{{ $errors->first('slug') }}</small>
</div>

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Item Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'title', 'required' => 'required', 'autofocus', 'onkeyup' => 'createslug()']) !!}
    <small class="text-danger">{{ $errors->first('name') }}</small>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id', $select_category, null, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('category_id') }}</small>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    {!! Form::label('price', 'Price') !!}
    {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('price') }}</small>
</div>

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

<div class="form-group text-right m-b-0">
  <a href="{{ empty($bread['0']) ? '#' : $bread['0']  }}" class="btn btn-white waves-effect waves-light m-l-5">
    Cancel
  </a>
  <button class="btn btn-primary waves-effect waves-light" type="submit">
    Submit
  </button>
</div>
