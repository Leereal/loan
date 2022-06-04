@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Add Guarantor')}}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('guarantors.store') }}">
					{{ csrf_field() }}
					<div class="row">
						<input type="hidden" name="user_id" value="{{ $user_id }}" required>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Name') }}</label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Employer') }}</label>
								<input type="text" class="form-control" name="employer" value="{{ old('employer') }}">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Cellphone') }}</label>
								<input type="text" class="form-control" name="cellphone" value="{{ old('cellphone') }}">
							</div>
						</div>

                        <div class="col-md-12">                            
                            <div class="form-group"> 
                                <label class="control-label">{{ _lang('Physical Address') }}</label>                                   
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


