@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<span class="panel-title">{{ _lang('Update Next Of Kin')}}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ action('NextOfKinController@update', $id) }}">
					{{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Name') }}</label>
								<input type="text" class="form-control" name="name" value="{{ $next_of_kin->name  }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Relationship') }}</label>
								<input type="text" class="form-control" name="relationship" value="{{ $next_of_kin->relationship  }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Cellphone') }}</label>
								<input type="text" class="form-control" name="cellphone" value="{{ $next_of_kin->cellphone  }}">
							</div>
						</div>

                        <div class="col-md-12">                            
                            <div class="form-group"> 
                                <label class="control-label">{{ _lang('Physical Address') }}</label>                                   
                                <textarea class="form-control" name="address">{{ $next_of_kin->address  }}</textarea>
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


