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



                <br/>
                <p class="goback"><a href="{{URL::action('HomeController@getIndex')}}"> Terug naar de homepage </a></p>

            </div>
        </div>
        @if($news->comments == 1)
            <h2>Reacties</h2>
            @foreach($news->newscomments as $comment)
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

            <div class="row">
                <div class="col-lg-6">
                    {{--Post a comment, not finished yet.
                    Also there needs to be an login check later on--}}
                    {!! Form::open(array('action' => 'NewsController@postComment')) !!}
                    <h3>Plaats een reactie</h3>
                    <div class="form-group">
                        <input type="hidden" name="newsId" value="{{$news->newsId}}">
                        <textarea name="comment" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" style="float: right;">Plaats reactie</button>
                    {!! Form::close() !!}
                </div>
            </div>
        @endif
    </div>
    @endif
@endsection