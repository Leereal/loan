<form method="post" class="ajax-screen-submit" autocomplete="off" action="{{ route('withdraw.manual_withdraw',$withdraw_method->id) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Amount') }}</label>
                <input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
            </div>
        </div>
        @if(!empty($withdraw_method->requirements))
            @foreach($withdraw_method->requirements as $requirement)
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ $requirement }}</label>
                    <input type="text" class="form-control" name="requirements[{{ str_replace(' ','_',$requirement) }}]" required>
                </div>
            </div>
            @endforeach
        @endif

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Description') }}</label>
                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">{{ _lang('Attachment') }}</label>
                <input type="file" class="form-control dropify" name="attachment">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
            </div>
        </div>
    </div>
</form>
