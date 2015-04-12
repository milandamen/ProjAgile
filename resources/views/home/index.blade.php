@extends('app')

@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                {{-- Require de carousel hier --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-header">De Bunders</h2>
            </div>
        </div>

        <!-- Module placement -->
        <div class="row">
            {{-- Script for laying out modules on correct spots --}}
            <div class="col-md-8">
                @for ($i = 0; $i < count($layoutModules) - 1; $i++)					{{-- Loop all modules, except the last one --}}
                    @include('home.partials._' . $layoutModules[$i]->moduleName)
                @endfor
            </div>

            <div class="col-md-4">
                @include('home.partials._' . $layoutModules[count($layoutModules) - 1 ]->moduleName)
            </div>
            {{-- End layout script --}}
        </div>
    </div>
@stop

@section('additional_scripts')
    <!-- JavaScript that enables the sliding upwards of flash messages -->
    {!! HTML::script('custom/js/flash_message.js') !!}
@stop