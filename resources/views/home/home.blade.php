@extends('layouts.master')

@section('main_content')

        {{-- Include modules --}}
        @foreach ($modules as $module)
		   {!! $module !!}
		@endforeach
		{{-- End include modules --}}

@endsection