@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">{{ _lang('Create Role') }}</h4>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('roles.store') }}"
					enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Name') }}</label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Multiple Branch') }}</label>
								<select class="form-control auto-select" data-selected="{{ old('multiple_branch') }}"
									name="multiple_branch" required>
									<option value="">{{ _lang('Select One') }}</option>
									<option value="1">{{ _lang('Allow') }}</option>
									<option value="0">{{ _lang('Deny') }}</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Description') }}</label>
								<textarea class="form-control" name="description">{{ old('description') }}</textarea>
							</div>
						</div>


						<div class="col-md-12">
							<div class="form-group">
								<button type="reset" class="btn btn-danger">{{ _lang('Reset') }}</button>
								<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{
									_lang('Save') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection