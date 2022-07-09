@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
			<div class="card-header d-flex align-items-center">
				<div class="col-md-3">
					<span class="panel-title">{{ _lang('Transactions') }}</span>
				</div>
				<div class="ml-auto col-md-9" style="overflow-y:scroll;">
					<table class="">
						<tr>
							<td>
								<span class="form-group float-left mr-2">
									<input type="text" class=" datepicker select-filter filter-select" name="from_date"
										value="">
								</span>
							</td>
							<td>
								<span class="form-group float-left mr-2">
									<input type="text" class=" datepicker select-filter filter-select" name="to_date"
										value="">
								</span>
							</td>
							<td>
								<span class="form-group">
									<label for="age">{{ _lang('All Transactions') }}</label>
									<select name="type" class="ml-auto select-filter filter-select">
										<option value="">{{ _lang('All') }}</option>
										@foreach ($transactions as $transaction )
										<option value="{{ $transaction->type }}">{{ _lang($transaction->note) }}
										</option>
										@endforeach
									</select>
								</span>
							</td>
							<td>
								<span class="form-group">
									<label for="age">Status</label>
									<select name="status" class="ml-auto select-filter filter-select">
										<option value="">{{ _lang('All') }}</option>
										<option value="1">{{ _lang('Pending') }}</option>
										<option value="2">{{ _lang('Approved') }}</option>
										<option value="0">{{ _lang('Rejected') }}</option>
									</select>
								</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="card-body">
				<table id="transactions_table" class="table table-bordered">
					<thead>
						<tr>
							<th>{{ _lang('Date') }}</th>
							<th>{{ _lang('Client Account') }}</th>
							<th>{{ _lang('Currency') }}</th>
							<th>{{ _lang('DR/CR') }}</th>
							<th>{{ _lang('Type') }}</th>
							<th>{{ _lang('Amount') }}</th>
							<th>{{ _lang('Status') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')
<script src="{{asset('backend/assets/js/datatables/all_transactions.js') }}"></script>
@endsection