@extends('app')
<!-- Page Content -->
@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h1>Wijzig sidebar </h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!--- Start Form of updating the sidebar -->
			<form name="sidebar" id="updateSidebar" method="post" enctype="multipart/form-data" action="/sidebar/update/{{ $sidebar[0]->pageNr }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="maxRowIndex" id="maxRowIndex" class="hiddenInput" />
				
                <hr>
                Koptekst: <input type="text" name="title" id="sidebarTitle" value="{{ $sidebar[0]->title}} " required> <br/><br/>
                
               
                <!-- Add new row-button -->
				<table name="X" id="sidebarTable" class="col-md-12">
					<tr>
						<td>
							<button type="button" onclick="addSideRow(this)" class="btn btn-warning">Voeg rij toe</button>
						</td>
					</tr>

				<!-- Loop through all fields and make editable. 	-->		
				{{--*/ $i = 0; /*--}}
                @foreach($sidebar as $sidebarRow)
                			<!-- Check if link goes out or stays in. -->
							<input type="number" name="sidebar[{{$i}}][rowId][]" id="rownumber" class="hiddenInput" value="{{$sidebarRow->id}}"/>
							<tr>
									<td class="td-tekst">Tekst: <input type="text" name="sidebar[{{$i}}][text][]" id="sidebarText" value="{{$sidebarRow->text}}" required> </td>
									<td class="td-intern">
									 Intern
										<input id="page_name" name="sidebar[{{$i}}][pagename][]" type="text" list="pagedata" />
										<datalist id="pagedata">
									
											@foreach($menu as $menuitem)
												<option value="{{$menuitem->relativeUrl}}" label="{{$menuitem->name}}"> 
											@endforeach

										</datalist>
									</td>
									<td class="td-link" >Link naar: <input type="text" name="sidebar[{{$i}}][link][]" id="sidebarLink" value="{{$sidebarRow->link}}"> </td>
								
							<!--- Make decision for intern or extern link -->
							<td class="td-radio1">
								@if(!$sidebarRow->extern)
								
								<div class="radio">
  									<label class="radio-inline"><input type="radio"  name="sidebar[{{$i}}][radio1]" value="Extern">Extern</label>
									<label class="radio-inline active"><input type="radio"  name="sidebar[{{$i}}][radio1]" value="Intern" checked="">Intern</label>
								</div> 
								@else  
								<div class="radio">
  									<label class="radio-inline"><input type="radio" name="sidebar[{{$i}}][radio1]" value="Extern" checked="">Extern</label>
									<label class="radio-inline active"><input type="radio" name="sidebar[{{$i}}][radio1]" value="Intern">Intern</label>
								</div>
								
								@endif	
							</td>
							
							 <!-- Row removal button -->
							<td><button type="text" onclick="removeSideRow(this)" class="btn btn-danger btn-xs">X</button></td> </tr>
						{{--*/ $i++;	/*--}}	
				@endforeach 				
					</table>
				<div id="success"></div>
				<button type="button" class="btn btn-danger" onclick="goBack()">Annuleer</button>
				<button type="submit" class="btn btn-success">Opslaan</button>
			</form>
		</div>
	</div>
@endsection


	@section('additional_scripts')
 <!-- JavaScript that enables adding and removing rows -->
   
    {!! HTML::script('custom/js/sidebar.js') !!}
    @endsection
