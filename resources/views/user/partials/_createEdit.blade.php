<div class="col-lg-5">
	@if(isset($managementMode) && $managementMode)
		<div class="form-group">
			{!! Form::label('username', 'Gebruikersnaam') !!}
			{!! Form::text('username', old('username'), ['class' => 'form-control']) !!}
		</div>
	@endif
	<div class="form-group">
		{!! Form::label('firstName', 'Voornaam') !!}
		{!! Form::text('firstName', old('firstName'), ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('insertion', 'Tussenvoegsel') !!}
		{!! Form::text('insertion', old('insertion'), ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('surname', 'Achternaam') !!}
		{!! Form::text('surname', old('surname'), ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('email', 'E-mailadres') !!}
		{!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('email_confirmation', 'Herhaal E-mailadres') !!}
		{!! Form::email('email_confirmation', old('email_confirmation') ? : $user->email, ['class' => 'form-control']) !!}
	</div>
</div>
<div class="col-lg-5 col-lg-offset-1">
	<div class="form-group">
		@if(isset($editMode) && $editMode)
			{!! HTML::decode(Form::label('password', 'Wachtwoord <small><t>*alleen invullen als u het wachtwoord wilt wijzigen</small>')) !!}
		@else
			{!! Form::label('password', 'Wachtwoord') !!}
		@endif
		{!! Form::password('password', ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('password_confirmation', 'Herhaal Wachtwoord') !!}
		{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
	</div>
	@if(isset($managementMode) && $managementMode)
		<div class="form-group">
			{!! Form::label('houseNumber', 'Huisnummer') !!}
			@if(isset($houseNumber))
				{!! Form::text('houseNumber', old('houseNumber') ? : $houseNumber->houseNumber, ['class' => 'form-control']) !!}
			@else
				{!! Form::text('houseNumber', old('houseNumber'), ['class' => 'form-control']) !!}
			@endif
		</div>
		<div class="form-group">
			{!! Form::label('suffix', 'Toevoeging') !!}
			@if(isset($houseNumber))
				{!! Form::text('suffix', old('suffix') ? : $houseNumber->suffix, ['class' => 'form-control']) !!}
			@else
				{!! Form::text('suffix', old('suffix'), ['class' => 'form-control']) !!}
			@endif
		</div>
		<div class="form-group">
			{!! Form::label('postal', 'Postcode') !!}
			@if(isset($postal))
				{!! Form::text('postal', old('postal') ? : $postal->code, ['class' => 'form-control']) !!}
			@else
				{!! Form::text('postal', old('postal'), ['class' => 'form-control']) !!}
			@endif
		</div>
	@endif
</div>
@if(isset($managementMode) && $managementMode)
	<div class="col-lg-3 col-lg-offset-1">
		<div class="form-group">
			{!! Form::label('userGroupId', 'Gebruikersgroep') !!}
			{!! Form::select('userGroupId', $userGroups, old('userGroupId'), ['class' => 'form-control']) !!}
		</div>
	</div>
@endif
<div class="col-lg-12">
	<div class="form-group">
		@if(isset($managementMode) && $managementMode)
			{!! link_to_route('user.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
		@else
			{!! link_to_route('user.showProfile', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
		@endif
		{!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
	</div>
</div>