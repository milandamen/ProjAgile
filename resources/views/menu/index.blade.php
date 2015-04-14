@extends('app')

@section('content')
    <div class="container">
        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Menu Beheer</h2>
                {{ $allMenuItems }}


            </div>
        </div>
    </div>
@stop