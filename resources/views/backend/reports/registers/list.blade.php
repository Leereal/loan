@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex align-items-center">
				<span class="panel-title">{{ _lang('Registers') }}</span>
				<div class="ml-auto">
					<span class="form-group">
						<label for="age">Age Analysis</label>
						<select name="age" class="select-filter filter-select">
							<option value="">{{ _lang('All') }}</option>
							@foreach ($ages as $age )
							<option value="{{ $age }}">{{ _lang($age) }}</option>
							@endforeach
						</select>
					</span>
					<span class="form-group">
						<label for="currency">Currency</label>
						<select name="currency" class="select-filter filter-select">
							<option value="">{{ _lang('All') }}</option>
							@foreach ($currencies as $currency )
							<option value="{{ $currency->id }}">{{ _lang($currency->name) }}</option>
							@endforeach
						</select>
					</span>
					<span class="form-group">
						<label for="branch">Branch</label>
						<select name="branch" class="select-filter filter-select">
							<option value="">{{ _lang('All') }}</option>
							@foreach ($branches as $branch )
							<option value="{{ $branch->id }}">{{ _lang($branch->name) }}</option>
							@endforeach
						</select>
					</span>
					<span class="form-group">
						<label for="status">Loan Status</label>
						<select name="status" class="select-filter filter-select">
							<option value="">{{ _lang('All') }}</option>
							{{-- <option value="0">{{ _lang('Pending') }}</option> --}}
							<option value="1">{{ _lang('Approved') }}</option>
							{{-- <option value="2">{{ _lang('Completed') }}</option> --}}
							{{-- <option value="3">{{ _lang('Cancelled') }}</option> --}}
							<option value="4">{{ _lang('Overdue') }}</option>
							<option value="5">{{ _lang('Internal') }}</option>
							<option value="6">{{ _lang('Bad Debts') }}</option>
						</select>
					</span>

					<a class="btn btn-primary btn-sm" href="{{ route('registers.index') }}"><i
							class="icofont-refresh"></i>
						{{ _lang('Refresh') }}</a>
				</div>
			</div>

			<div class="card-body">
				<table id="registers_table" class="table table-bordered">
					<thead>
						<tr>
							<th>{{ _lang('Name') }}</th>
							<th>{{ _lang('Interest Rate') }}</th>
							<th>{{ _lang('Disbursements') }}</th>
							<th>{{ _lang('Repayments') }}</th>
							<th>{{ _lang('Quantity') }}</th>
							<th>{{ _lang('Book Value') }}</th>
							<th>{{ _lang('Branch') }}</th>
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
<script src="{{ asset('backend/assets/js/datatables/registers.js') }}"></script>
@endsection