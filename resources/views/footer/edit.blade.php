@extends('app')

@section('content')
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
                <hr/>
                <input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
                <div id="footer-tables" class="footer-tables">
                    @for($c = 0; $c < count($footer); $c++)
                        <table name="{{$c}}" class="col-sm-4">
                            <tr>
                                <td>
                                    <button type="button" onclick="addRow(this)" class="btn btn-primary btn-sm">Voeg link toe</button>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>

                        @for($r = 0; $r < count($footer[$c]); $r++)
                            <tr>
                                <td>
                                    Tekst: <input type="text" name="footer[{{$c}}][text][]" id="footerText" value="{{$footer[$c][$r]->text}}" maxlength="22 " required>
                                    <button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>
                                    <br/> Link: &nbsp; <input type="text" name="footer[{{$c}}][link][]" class="autocomplete" id="footerLink" value="{{$footer[$c][$r]->link}}">
                                </td>
                            </tr>
                        @endfor
                        </table>
                    @endfor
                </div>
                <div id="success" class="col-lg-12">
                    <br/>
                    <button type="button" class="btn btn-danger" onclick="location.href='{{route('admin.index', '')}}'">Annuleren</button>
                    <button type="submit" class="btn btn-success" onclick="validate()">Opslaan</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    var autocompleteURL = "{!! route('autocomplete.autocomplete', '') !!}";
</script>
@endsection

@section('additional_scripts')
    <!-- JavaScript that enables adding and removing columns and rows -->
    {!! HTML::script('custom/js/footerUpdate.js') !!}
    {!! HTML::script('custom/js/autocomplete.js') !!}
@endsection


