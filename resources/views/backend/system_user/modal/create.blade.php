<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ route('system_users.store') }}"
	enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="row p-2">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Name') }}</label>
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Email') }}</label>
				<input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
			</div>
		</div>


		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Password') }}</label>
				<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('User Type') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ old('user_type') }}" name="user_type"
					id="user_type" required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="admin">{{ _lang('Admin') }}</option>
					<option value="user">{{ _lang('User') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('User Role') }}</label>
				<select class="form-control select2-ajax" data-href="{{ route('roles.create') }}"
					data-title="{{ _lang('Add New Role') }}" data-value="id" data-display="name" data-table="roles"
					id="role_id" name="role_id" disabled>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Branch') }}</label>
				<select class="form-control auto-select" data-selected="{{ old('branch_id') }}" name="branch_id"
					required>
					<option value="">{{ _lang('Select One') }}</option>
					{{ create_option('branches','id','name') }}
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>
				<select class="form-control select2 auto-select" data-selected="{{ old('status') }}" name="status"
					required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="1">{{ _lang('Active') }}</option>
					<option value="0">{{ _lang('In Active') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Profile Picture') }}</label>
				<input type="file" class="form-control dropify" name="profile_picture">
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
				<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save')
					}}</button>
			</div>
		</div>
	</div>
</form>