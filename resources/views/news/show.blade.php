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
                    <p class="goback">{!! link_to_route('home.index', 'Terug naar de homepage') !!}</p>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        {{$news->title}}
                    </h2>
                </div>
                <div class="col-md-8">
                    <p class="news-info">
                        {{ $news->date }}
                        Door: {{ $news->user->username }} |
                        @if($news->districtSection != null)
                            {{ $news->districtSection->name }}
                        @else
                            Algemeen
                        @endif
                    </p>

                    {{$news->content}}
                    <br/>
                    @if(count($news->files) > 0)
                        <br/><p>{{'Bijlagen:'}}</p>
                    @endif

                    @foreach($fileLinks as $link)
                        {!! $link !!}
                    @endforeach

                    <br/>
                    <p class="goback">{!! link_to_route('home.index', 'Terug naar de homepage') !!}</p>

                </div>
            </div>
            @if($news->newsComments->count() > 0)
                <h2>Reacties</h2>
                @foreach($news->newsComments as $comment)
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>{{$comment->user->username}}</h4>
                            <p>{{$comment->message}}</p>
                            <br/>
                            <h6>{{$comment->created_at}}</h6>
                            <hr>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-lg-6">
                    {{--Post a comment, not finished yet.
                    Also there needs to be an login check later on--}}
                    {!! Form::open(['route' => 'news.postComment', 'method' => 'POST']) !!}
                        <h3>Plaats een reactie</h3>
                        <div class="form-group">
                            <input type="hidden" name="newsId" value="{{$news->newsId}}">
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" style="float: right;">Plaats reactie</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection