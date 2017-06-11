@extends('layouts.app')


@section('content')
  <div class="container">

        @include('layouts.partials._bread', ['data' => empty($bread) ? '' : $bread])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="card-box">

                {!! Form::model($hot_offer, ['route' => ['hot_offer.update', $hot_offer->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                    @include('pages.hot_offer._form')
                {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- end row -->
  </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#lfm').filemanager('image');
        });
    </script>
@endsection
