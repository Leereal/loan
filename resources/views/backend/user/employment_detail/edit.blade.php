@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Update Employement Details')}}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off"
					action="{{ action('EmploymentDetailController@update', $id)}}">
					{{ csrf_field() }}
					<input name="_method" type="hidden" value="PATCH">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Employer Name') }}</label>
								<select class="form-control select2 auto-select"
									data-selected="{{ $employment_detail->name }}" name="name" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('employers','id','name') }}
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Salary') }}</label>
								<input type="text" class="form-control" name="salary"
									value="{{ $employment_detail->salary  }}">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">{{ _lang('Save Changes') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection