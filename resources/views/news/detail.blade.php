@extends('app')

@section('content')
    @if($news == null)
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Dit artikel bestaat niet!</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <p class="goback"><a href="{{URL::action('HomeController@getIndex')}}"> Terug naar de homepage </a></p>
                </div>
            </div>

        </div>
    @else
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    {{$news->title}}</h2>
            </div>

            <div class="col-md-8">
                <p class="news-info"> {{$news->date}} Door: {{$news->user->username}} | @if($news->district != null) {{$news->district->name}} @else Algemeen @endif</p>

                {{$news->content}}
                <br/>
                @if(count($news->files) > 0)
                    <br/><p>{{'Bijlagen:'}}</p>
                @endif

                @foreach($fileLinks as $link)
                    {!! $link !!}
                @endforeach

                @if($news->comments == 1)
                    {{-- get the comments and display them --}}

                    <form action="#" method="post">
                        <h3>Plaats een reactie</h3>
                        <textarea class="form-control"></textarea>
                    </form>

                @endif

                <br/>
                <p class="goback"><a href="{{URL::action('HomeController@getIndex')}}"> Terug naar de homepage </a></p>

            </div>
        </div>
        @foreach($news->newscomments as $comment)
            <div class="row">
                <div class="col-lg-4">
                    <h4>{{$comment->user->username}}</h4>
                    <p>{{$comment->message}}</p>
                    <br/>
                    <h6>{{$comment->created_at}}</h6>
                    <hr>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@endsection