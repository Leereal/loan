@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">{{ _lang('Create Client') }}</h4>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="{{ route('users.store') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('File Number') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="file_number"
                                        value="{{ old('file_number') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Title') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('title') }}"
                                        name="title" required>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Dr">Dr</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Full Name') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('ID Number') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="id_number"
                                        value="{{ old('id_number') }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select"
                                        data-selected="{{ old('country_code') }}" name="country_code" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        @foreach(get_country_codes() as $key => $value)
                                        <option value="{{ $value['dial_code'] }}">{{ $value['country'].'
                                            (+'.$value['dial_code'].')' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>
                                <div class="col-xl-9">
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                        required>
                                    <p>eg: 772123456</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Physical Address') }}</label>
                                <div class="col-xl-9">
                                    <textarea class="form-control" name="address">{{ old('address') }}</textarea required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Branch') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('branch_id') }}"
                                        name="branch_id" required>
                                        <option value="">{{ _lang('Select One') }}</option>
					                    {{ create_option('branches','id','name') }}
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control auto-select" data-selected="{{ old('status') }}"
                                        name="status" required>
                                        <option value="">{{ _lang('Select One') }}</option>
                                        <option value="1">{{ _lang('Active') }}</option>
                                        <option value="0">{{ _lang('In Active') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Email Verified') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select" name="email_verified_at">
                                        <option value="">{{ _lang('No') }}</option>
                                        <option value="{{ now() }}">{{ _lang('Yes') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>
                                <div class="col-xl-9">
                                    <select class="form-control select2 auto-select" name="sms_verified_at">
                                        <option value="">{{ _lang('No') }}</option>
                                        <option value="{{ now() }}">{{ _lang('Yes') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                                <div class="col-xl-9">
                                    <input type="file" class="form-control dropify" name="profile_picture">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-xl-9 offset-xl-3">
                                    <button type="submit" class="btn btn-primary">{{ _lang('Create Client') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection