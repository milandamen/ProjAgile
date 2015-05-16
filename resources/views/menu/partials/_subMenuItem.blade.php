@foreach ($items as $item)
	<li class='route'>
		<h3 class='title'>
			<i class="fa fa-arrows">&nbsp;&nbsp;&nbsp;</i>
			{{ $item['main']->name }}
			<div class="pull-right">
				@if ($item['main']->publish == 0)
					<i class="fa fa-eye-slash"></i>
				@else
					<i class="fa fa-eye"></i>
				@endif
				{!! link_to_route('menu.edit', '', [e($item['main']->menuId)], ['class' => 'fa fa-pencil-square-o']) !!}
				<a onclick="removeItem(this)" href="javascript:void(0)">
					<i class="fa fa-times text-danger"></i>
				</a>
			</div>
		</h3>
		{!! Form::hidden($item['main']->menuId, $item['main']->menuOrder, ['class' => 'menuGroupItem'] ) !!}
		<ul class='space'>
		@if(isset($item['sub']))
			@include('menu.partials._subMenuItem', ['items' => $item['sub'], 'main' => $item])
		@endif
		</ul>
	</li>
@endforeach