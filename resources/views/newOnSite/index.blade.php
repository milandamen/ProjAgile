@extends('app')
@section('content')
    <div class="container">
        {!! Breadcrumbs::render('newOnSiteIndex') !!}
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">Nieuw op de site</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Wijziging</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->message}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection