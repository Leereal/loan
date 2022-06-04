@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Add Employement Details')}}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('employment_details.store') }}">
					{{ csrf_field() }}
					<div class="row">
						<input type="hidden" name="user_id" value="{{ $user_id }}" required>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Employer Name') }}</label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Salary') }}</label>
								<input type="text" class="form-control" name="salary" value="{{ old('salary') }}">
							</div>
						</div>                     

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Telephone') }}</label>
								<input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">
							</div>
						</div>

                        <div class="col-md-12">                            
                            <div class="form-group"> 
                                <label class="control-label">{{ _lang('Address') }}</label>                                   
                                <textarea class="form-control" name="address">{{ old('address') }}</textarea>
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


