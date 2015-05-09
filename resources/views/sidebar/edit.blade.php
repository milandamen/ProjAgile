@extends('app')

@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('sidebarpage', (object)['id' => $sidebarList[0]->page_pageId, 'title' => $sidebarList[0]->title]) !!}
			</div>

        <div class="row">
            <div class="col-md-12">
                <h1>Wijzig sidebar</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--- Start Form of updating the sidebar -->
                <form name="sidebar" id="updateSidebar" method="post" enctype="multipart/form-data" action="{!! route('sidebar.update', [$sidebarList[0]->page_pageId]) !!}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="text" name="maxRowIndex" id="maxRowIndex" class="hiddenInput" />
                    <input id="newOnSiteCheck" type="hidden" name="toNewOnSite" value="FALSE">
                    <input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">

                    <hr>
                    Koptekst:
                    <input type="text" name="title" id="sidebarTitle" value="{!! $sidebarList[0]->title!!} " required> <br/><br/>
                    <!-- Add new row-button -->
                    <table name="X" id="sidebarTable" class="col-md-12">
                        <tr>
                            <td>
                                <button type="button" onclick="addSideRow(this)" class="btn btn-primary">Voeg rij toe</button>
                            </td>
                        </tr>

                        <!-- Loop through all fields and make editable. 	-->
                        {{--*/ $i = 0; /*--}}
                        @foreach($sidebarList as $sidebarRow)
                        <!-- Check if link goes out or stays in. -->
                        <tr>
                        	<td class="hidden form-control"><input type="number" name="sidebar[{!!$i!!}][rowId][]" id="rownumber" class="hiddenInput" value="{!!$sidebarRow->id!!}"/></td>
                            <td class="td-tekst">
                                Tekst:
                                <input type="text" name="sidebar[{!!$i!!}][text][]" id="sidebarText" value="{!!$sidebarRow->text!!}" required>
                            </td>

                            <td class="td-intern">
                                Link
                                <input id="page_name" class="autocomplete" name="sidebar[{!!$i!!}][pagename][]" id="sidebarLink" value="{!!$sidebarRow->link!!}" type="text"/>
                            </td>

                            <!--- Make decision for intern or extern link -->
                            <td class="td-radio1">
                                @if(!$sidebarRow->extern)
                                    <div class="radio">
                                        <label class="radio-inline"><input type="radio"  name="sidebar[{!!$i!!}][radio1]" value="Extern">Extern</label>
                                        <label class="radio-inline active"><input type="radio"  name="sidebar[{!!$i!!}][radio1]" value="Intern" checked="">Intern</label>
                                    </div>
                                @else
                                    <div class="radio">
                                        <label class="radio-inline"><input type="radio" name="sidebar[{!!$i!!}][radio1]" value="Extern" checked="">Extern</label>
                                        <label class="radio-inline active"><input type="radio" name="sidebar[{!!$i!!}][radio1]" value="Intern">Intern</label>
                                    </div>
                                @endif
                            </td>

                            <!-- Row removal button -->
                            @if($i >= 1)
                            <td>
                                <button type="text" onclick="removeSideRow(this)" class="btn btn-danger btn-xs">X</button>
                            </td>
                            @else
                            <td>

                            </td>
                            @endif
                        </tr>
                        {{--*/ $i++;	/*--}}
                        @endforeach
                    </table>
                    <div id="success">
                        <button type="button" class="btn btn-danger" onclick="location.href='{{route('admin.index')}}'">Annuleer</button>
                        <button type="submit" class="btn btn-success" onclick="validate()">Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    var autocompleteURL = "{!! route('autocomplete.autocomplete', '') !!}";
</script>

@endsection

@section('additional_scripts')
    <!-- JavaScript that enables adding and removing rows -->
	{!! HTML::script('custom/js/sidebar.js') !!}
    {!! HTML::script('custom/js/autocomplete.js') !!}
    {!! HTML::script('custom/js/validateNewOnSite.js') !!}
@endsection