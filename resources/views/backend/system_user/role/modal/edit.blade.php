<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ action('RoleController@update', $id) }}"
	enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Name') }}</label>
			<input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Multiple Branch') }}</label>
			<select class="form-control auto-select" data-selected="{{ $role->multiple_branch }}" name="multiple_branch"
				required>
				<option value="">{{ _lang('Select One') }}</option>
				<option value="1">{{ _lang('Allow') }}</option>
				<option value="0">{{ _lang('Deny') }}</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Description') }}</label>
			<textarea class="form-control" name="description">{{ $role->description }}</textarea>
		</div>
	</div>


	<div class="form-group">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update')
				}}</button>
		</div>
	</div>
</form>