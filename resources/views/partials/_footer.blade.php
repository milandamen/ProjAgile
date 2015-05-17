@if(count($footer) > 3)
    <div class="container">
        <!-- Footer -->
        <hr>
        <div style="background-color: {{$footer[3]->text}}" class="col-md-12 footer panel panel-default">
            <!---1, because id 4 is for the color-->
            @for($c = 0; $c < count($footer) - 1; $c++)
                <div class="footerlist-container">
                    <ul class="col-sm-4">
                        {!!$footer[$c]->text!!}
                    </ul>
                </div>
            @endfor
            <div class="footer-edit-link">
                @if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
                        <a href="{{route('footer.edit')}}"><i class="fa fa-pencil-square-o"></i></a>
                @endif
            </div>
        </div>
    </div>
@endif