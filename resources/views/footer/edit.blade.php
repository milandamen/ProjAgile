@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('footer.edit') !!}
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
					<input id="newOnSiteMessage" type="hidden" name="newOnSiteMessage" value="">
					<div id="footer-tables" class="col-sm-8">
						@for($c = 0; $c < count($footer); $c++)
							<table name="{{$c}}" class="col-sm-7 form-group">
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
										</td>
										<td>
											Link: &nbsp; <input type="text" name="footer[{{$c}}][link][]" class="autocomplete" id="footerLink" value="{{$footer[$c][$r]->link}}">
										</td>
										<td>
											@if($r >= 1)
												<button type="button" onclick="removeRow(this)" class="btn btn-danger btn-xs">X</button>
											@else 
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
											@endif
										</td>
									</tr>
								@endfor
							</table>
						@endfor
					</div>
					<div id="success" class="col-lg-12">
						<br/>
						<button type="button" class="btn btn-danger" onclick="location.href='{{route('admin.index')}}'">Annuleren</button>
						<button type="submit" class="btn btn-success" onclick="validate()">Opslaan</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<script>
		var autocompleteURL = "{!! route('autocomplete.autocomplete', '') !!}";
	</script>
@stop

@section('additional_scripts')
	<!-- JavaScript that enables adding and removing columns and rows -->
	{!! HTML::script('custom/js/footerUpdate.js') !!}
	{!! HTML::script('custom/js/autocomplete.js') !!}
	{!! HTML::script('custom/js/validateNewOnSite.js') !!}
@stop