@extends('layouts.app')

@section('styles')
  <!-- DataTables CSS -->
  <link href="{{ asset('assets/plugins/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="{{ asset('assets/plugins/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection


@section('content')
  <div class="container">

        @include('layouts.partials._bread', ['data' => empty($bread) ? '' : $bread])

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Hot Offers</b></h4>
                    <p> <a class="btn btn-default" href="{{ route('hot_offer.create') }}">Add Hot Offer</a> </p>
                    {!! $html->table(['class'=>'table table-striped table-bordered', "id"=>"datatable"]) !!}
                </div>
            </div>
        </div>
        <!-- end row -->
  </div>
@endsection

@section('scripts')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/dataTables.responsive.js') }}"></script>
    {!! $html->scripts() !!}
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
            $('#lfm').filemanager('image');
        });
    </script>
@endsection
