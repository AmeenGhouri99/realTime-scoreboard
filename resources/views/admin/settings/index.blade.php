@extends('admin.layouts.main')
@section('main-section')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">

            <!-- Bread Crumb START-->
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{ __('general.Settings') }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{ __('general.Dashboard') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('general.Settings') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <a class="dt-button create-new btn btn-primary" href="{{ route('admin.dashboard') }}"><i
                                data-feather='arrow-left'></i></a>
                    </div>
                </div>
            </div>
            <!-- Bread Crumb END-->

            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <!-- profile -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{ __('general.profile_detail') }}</h4>
                            </div>

                            <div class="card-body py-2 my-25">
                                @include('flash::message')
                                <!-- form -->
                                {!! Form::model($user, [
                                    'route' => ['admin.setting.profile.update', $user->id],
                                    'method' => 'post',
                                    'files' => true,
                                ]) !!}
                                <div class="d-flex">
                                    <a href="#" class="me-25">
                                        <img src="{{ $user->profile_image_url ? asset($user->profile_image_url) : asset('app-assets/no-image-icon.png') }}"
                                            id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image"
                                            height="100" width="100" />
                                    </a>
                                    <!-- upload and reset button -->
                                    <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                            <label for="account-upload"
                                                class="btn btn-sm btn-primary mb-75 me-75">{{ __('general.upload') }}</label>
                                            <input type="file" id="account-upload" name="profile_image" hidden
                                                accept="image/*" />
                                            <p class="mb-0">{{ __('general.allowed_file_sizes') }}</p>
                                        </div>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <div class="validate-form mt-2 pt-50">
                                    <div class="row">
                                        <div class="mb-1 col-12 col-sm-6">
                                            {!! Form::label('name', 'Name:') !!}
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            {!! Form::label('email', 'Email') !!}
                                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            {!! Form::label('password', __('general.old_password')) !!}
                                            {!! Form::password('old_password', ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            {!! Form::label('password', __('general.password')) !!}
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            {!! Form::label('password_confirmation', __('general.confirm_password')) !!}
                                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mt-1 me-1">{{ __('general.save_changes') }}</button>
                                            <button type="reset"
                                                class="btn btn-outline-secondary mt-1">{{ __('general.discard') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ form -->
                            </div>
                        </div>

                        {{-- <!-- deactivate account  -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Delete Account</h4>
                            </div>
                            <div class="card-body py-2 my-25">
                                <div class="alert alert-warning">
                                    <h4 class="alert-heading">Are you sure you want to delete your account?</h4>
                                    <div class="alert-body fw-normal">
                                        Once you delete your account, there is no going back. Please be certain.
                                    </div>
                                </div>
  
                                <form id="formAccountDeactivation" class="validate-form" onsubmit="return false">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" data-msg="Please confirm you want to delete account" />
                                        <label class="form-check-label font-small-3" for="accountActivation">
                                            I confirm my account deactivation
                                        </label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-danger deactivate-account mt-1">Deactivate Account</button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                        <!--/ profile -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('js_scripts')
    <script>
        $(document).ready(function() {
            var form = $('.validate-form'),
                accountUploadImg = $('#account-upload-img'),
                accountUploadBtn = $('#account-upload'),
                accountUserImage = $('.uploadedAvatar'),
                accountResetBtn = $('#account-reset');

            // Update user photo on click of button

            if (accountUserImage) {
                var resetImage = accountUserImage.attr('src');
                accountUploadBtn.on('change', function(e) {
                    var reader = new FileReader(),
                        files = e.target.files;
                    reader.onload = function() {
                        if (accountUploadImg) {
                            accountUploadImg.attr('src', reader.result);
                        }
                    };
                    reader.readAsDataURL(files[0]);
                });

                accountResetBtn.on('click', function() {
                    accountUserImage.attr('src', resetImage);
                });
            }
        });
    </script>
@endpush
