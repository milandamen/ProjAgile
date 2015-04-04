@extends('app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    {{$news->title}}</h2>
            </div>

            <div class="col-md-8">
                <p class="news-info">{{$news->date}} Door: {{$news->user->username}} | {{$news->district->name}}</p>

                {{$news->content}}
                <br/>
                @if(count($news->files) > 0)
                    <br/><p>{{'Bijlagen:'}}</p>
                @endif

                <?php //Blade does not support string manipulation so this is why php is used here.
                foreach($news->files as $file)
                {
                $withoutId = substr($file->path, stripos($file->path, 'd') + 1);
                echo '<a href="../../download/' . $file->path . '">'. $withoutId . '</a><br/>';

                }?>

                <br/>
                <p class="goback"><a href="../../"> Terug naar de homepage </a></p>

            </div>

@endsection