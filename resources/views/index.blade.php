@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form-component action="{{route('leads.store')}}"
                                route-get-marks="{{route('autoria.marks')}}"
                                route-get-models="{{route('autoria.models')}}"
                                route-get-categories-auto="{{route('autoria.categories')}}">
                </form-component>
            </div>
        </div>
    </div>
@endsection
