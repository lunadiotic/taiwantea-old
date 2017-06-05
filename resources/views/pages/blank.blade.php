@extends('layouts.main')

@section('content')
<div class="container">

	@include('layouts.partials._bread', ['data' => empty($bread) ? '' : $bread])

</div> <!-- container -->
@endsection