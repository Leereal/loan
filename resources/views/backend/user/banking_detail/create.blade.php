@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Add Banking Details')}}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('banking_details.store') }}">
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
								<label class="control-label">{{ _lang('Branch') }}</label>
								<input type="text" class="form-control" name="branch" value="{{ old('branch') }}">
							</div>
						</div>                     

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Account Type') }}</label>
								<input type="text" class="form-control" name="account_type" value="{{ old('account_type') }}">
							</div>
						</div>  
                        
                        <div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Account Number') }}</label>
								<input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}">
							</div>
						</div> 

                        <div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Payment Method') }}</label>
								<select class="form-control auto-select select2" data-selected="{{ old('withdraw_method_id') }}" name="withdraw_method_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('withdraw_methods','id','name',old('withdraw_method_id'), array('status=' => 1)) }}
								</select>
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


