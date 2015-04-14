@extends('app')

@section('content')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">

<div class="container">
    <div class="row">
        {!! Breadcrumbs::render('editfooter') !!}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1>Wijzig Footer</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => 'footer.postEdit', 'method' => 'POST']) !!}
                <button type="button" onclick="addColumn()" class="btn btn-primary">Voeg kolom toe</button>
                <hr/>
                <div id="footer-tables" class="footer-tables">
                    @for($c = 0; $c < count($footer); $c++)
                        <table name="{{$c}}" class="col-sm-4">
                            <tr>
                                <td>
                                    <button type="button" onclick="addRow(this)" class="btn btn-primary btn-sm">Voeg link toe</button>
                                    <button type="button" onclick="removeColumn(this)" class="btn btn-primary btn-sm">Verwijder kolom</button>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>

                        @for($r = 0; $r < count($footer[$c]); $r++)

                            {{--*/ $link = '#'; /*--}}

                            @if($footer[$c][$r]->link != null)
                                {{--*/ $link = $footer[$c][$r]->link; /*--}}
                            @endif

                            @if($r === 0)

                                <tr>
                                    <td>
                                        Titel: <input type="text" name="footer[{{$c}}][text][]" id="footerText" value="{{$footer[$c][$r]->text}}" required>
                                        <button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>
                                        <br/> Link: <input type="text" name="footer[{{$c}}][link][]" class="footerAutocomplete" id="footerLink" value="{{$footer[$c][$r]->link}}">
                                    </td>
                                </tr>

                            @else
                                <tr>
                                    <td>
                                        Text: <input type="text" name="footer[{{$c}}][text][]" id="footerText" value="{{$footer[$c][$r]->text}}" required>
                                        <button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>
                                        <br/> Link: <input type="text" name="footer[{{$c}}][link][]" class="footerAutocomplete" id="footerLink" value="{{$footer[$c][$r]->link}}">
                                    </td>
                                </tr>
                            @endif

                        @endfor
                        </table>
                    @endfor
                </div>
                <div id="success" class="col-lg-12">
                    <br/>
                    <button type="button" class="btn btn-danger" onclick="goBack()">Annuleren</button>
                    <button type="submit" class="btn btn-success">Opslaan</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('additional_scripts')
    <!-- JavaScript that enables adding and removing columns and rows -->
    {!! HTML::script('custom/js/footerUpdate.js') !!}
    {!! HTML::script('custom/js/autocomplete.js') !!}
@endsection


