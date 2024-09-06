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
                            <h2 class="content-header-title float-start mb-0">{{__('general.Settings')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{__('general.Dashboard')}}</a></li>
                                    <li class="breadcrumb-item active">{{__('general.Settings')}}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bread Crumb END-->

            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        @include('admin.settings.setting_menu')
                        <!-- profile -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">{{__('general.Settings')}}</h4>
                            </div>
                            
                            <div class="card-body py-2 my-25">
                                <!-- form -->
                                {!! Form::open(['route' => 'admin.settings.update', 'class' => 'form']) !!}
                                <div class="row">
                                        <div class="mb-1 col-sm-6">
                                            {!! Form::label('ref_bonus_amount', __('general.referral_bonus_amount')) !!}
                                            {!! Form::number('referral_bonus_amount',settings('referral_bonus_amount'), ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="mb-1 col-sm-12">
                                            {!! Form::submit(__('general.submit'), ['class' => 'btn btn-primary', 'value'=> __('general.submit')]) !!}
                                            <a href="{{ route('admin.settings.index') }}" class="btn btn-light">{{ __('general.cancel')}}</a>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                        </div>

                        <!--/ profile -->
                    </div>
                </div>
  
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection