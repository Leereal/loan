@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Add New Loan') }}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('loans.store') }}"
					enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Borrower') }}</label>
								<select class="form-control auto-select select2"
									data-selected="{{ old('borrower_id') }}" name="borrower_id" id="borrower_id"
									required>
									<option value="">{{ _lang('Select One') }}</option>
									@foreach(get_table('users',array('user_type='=>'customer')) as $user )
									<option value="{{ $user->id }}">{{ $user->name .' ( ID :'. $user->id_number . ')' }}
									</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Loan Product') }}</label>
								<select class="form-control auto-select select2"
									data-selected="{{ old('loan_product_id') }}" name="loan_product_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('loan_products','id','name',old('loan_product_id'), array('status='
									=> 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Cash Out') }}</label>
								<input type="text" class="form-control float-field" id="cash-out" name="cash_out"
									value="{{ old('cash_out') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Applied Amount') }}</label>
								<input type="text" class="form-control float-field" id="applied-amount"
									name="applied_amount" value="{{ old('applied_amount') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Currency') }}</label>
								<select class="form-control auto-select" data-selected="{{ old('currency_id') }}"
									name="currency_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('currency','id','name','',array('status=' => 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('First Payment Date') }}</label>
								<input type="text" class="form-control datepicker" name="first_payment_date"
									value="{{ old('first_payment_date') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Release Date') }}</label>
								<input type="text" class="form-control datepicker" name="release_date"
									value="{{ old('release_date') }}" required>
							</div>
						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Payment Method') }}</label>
								<select class="form-control auto-select select2"
									data-selected="{{ old('withdraw_method_id') }}" name="withdraw_method_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('withdraw_methods','id','name',old('withdraw_method_id'),
									array('status=' => 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Attachment') }}</label>
								<input type="file" class="dropify" name="attachment" value="{{ old('attachment') }}">
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
								<label class="control-label">{{ _lang('Remarks') }}</label>
								<textarea class="form-control" name="remarks">{{ old('remarks') }}</textarea>
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
<script>
	document.addEventListener("DOMContentLoaded",()=>{
		const applyAmount = document.getElementById("applied-amount");
		const cashOut = document.getElementById("cash-out");
		const adminFee = document.getElementById("admin-fee");

		//If user focus out of admin fee input calculate value to add to input cash-out	or apply-amount	
		adminFee.addEventListener("blur",()=>{
			if(applyAmount.value != "" & cashOut.value == ""){		
				cashOut.value = Math.ceil(applyAmount.value * (1-adminFee.value/100));	
			}
			if(cashOut.value != "" & applyAmount.value == ""){		
				applyAmount.value = Math.ceil(cashOut.value / (1-adminFee.value/100));
			}
			if(cashOut.value != "" & applyAmount.value != ""){
				applyAmount.value = Math.ceil(cashOut.value / (1-adminFee.value/100));
			}					
		});
	});
</script>
@endsection