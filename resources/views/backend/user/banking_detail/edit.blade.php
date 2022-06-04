@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Update Banking Details')}}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ action('BankingDetailController@update', $id)}}">
					{{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
					<div class="row">	
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Name') }}</label>
								<input type="text" class="form-control" name="name" value="{{ $banking_detail->name  }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch') }}</label>
								<input type="text" class="form-control" name="branch" value="{{ $banking_detail->branch }}">
							</div>
						</div>                     

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Account Type') }}</label>
								<input type="text" class="form-control" name="account_type" value="{{ $banking_detail->account_type }}">
							</div>
						</div>  
                        
                        <div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Account Number') }}</label>
								<input type="text" class="form-control" name="account_number" value="{{ $banking_detail->account_number }}">
							</div>
						</div> 

                        {{-- <div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Payment Method') }}</label>
								<select class="form-control auto-select select2" data-selected="{{ $banking_detail->withdraw_method_id }}" name="withdraw_method_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('withdraw_methods','id','name',$banking_detail->withdraw_method_id), array('status=' => 1) }}
								</select>
							</div>
						</div> --}}


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


