@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{ $leads->links() }}
                <div class="wrapper">
                    <h4 class="text-center">Лиды</h4>
                    <hr>
                    <leads-component
                        leads='@json($leads)'
                    ></leads-component>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('style')
    <style>
        .pagination {
            justify-content: center;
        }
    </style>
@endsection
