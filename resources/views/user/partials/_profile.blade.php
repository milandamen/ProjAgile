<tr>
	<td class="table-left">Voornaam:</td>
	<td>{{ $user->firstName }}</td>
</tr>
<tr>
	<td class="table-left">Tussenvoegsel:</td>
	<td>{{ $user->insertion }}</td>
</tr>
<tr>
	<td class="table-left">Achternaam:</td>
	<td>{{ $user->surname }}</td>
</tr>
<tr>
	<td class="table-left">E-mailadres:</td>
	<td>{{ $user->email }}</td>
</tr>
<tr>
	<td class="table-left">Postcode:</td>
	<td>
		@if(isset($postal))
			{{ $postal->code }}
		@endif
	</td>
</tr>
<tr>
	<td class="table-left">Huisnummer:</td>
	<td>
		@if(isset($houseNumber))
			{{ $houseNumber->houseNumber }}
		@endif
	</td>
</tr>
<tr>
	<td class="table-left">Toevoeging:</td>
	<td>
		@if(isset($houseNumber))
			{{ $houseNumber->suffix }}
		@endif
	</td>
</tr>
<tr>
	<td class="table-left">Deelwijk:</td>
	<td>
		@if(isset($districtSection))
			{{ $districtSection->name }}
		@endif
	</td>
</tr>