@extends('admin.layouts.main')
@section('main-section')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">

                <!-- Bread Crumb START-->
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">{{ __('general.Dashboard') }}</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">{{ __('general.Dashboard') }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <a href="{{ route('admin.users.index') }}">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h2 class="fw-bolder mb-0">{{ $total_users }}</h2>
                                        <p class="card-text">{{ __('general.total_users') }}</p>
                                    </div>
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <a href="{{ route('admin.users.index') }}?type=pending_users">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h2 class="fw-bolder mb-0">{{ $pending_users }}</h2>
                                        <p class="card-text">Pending Users</p>
                                    </div>
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather='alert-circle'class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-lg-3 col-sm-6 col-12">
                            <a href="{{route('admin.users.index')}}">
                                <div class="card">
                                    <div class="card-header">
                                        <div>
                                            <h2 class="fw-bolder mb-0">{{ $deleted_users}}</h2>
                                            <p class="card-text">Deleted Users</p>
                                        </div>
                                        <div class="avatar bg-light-danger p-50 m-0">
                                            <div class="avatar-content">
                                                <i data-feather='trash-2'class="font-medium-5"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                    {{-- <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Happen Auction Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        @foreach ($auction_product_details as $happen_auction_detail)
                                        @if ($happen_auction_detail->auction->type == App\Helpers\Constant::HAPPENING)
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="row" >
                                                    <div class="col-lg-6">
                                                        {{$loop->iteration."."}}
                                                        {{ $happen_auction_detail->product->name_en }}
                                                    </div>
                                                    <div class="col-lg-3" style="font-size: 8px">
                                                        {{ App\Helpers\Helper::convertDateTimeFromTimestamp($happen_auction_detail->start_time, 'g:iA') ." ". App\Helpers\Helper::convertDateTimeFromTimestamp($happen_auction_detail->end_time, 'g:iA') }}
                                                    </div>
                                                    <div class="col-lg-3" style="font-size: 8px">
                                                        @if ($happen_auction_detail->status == App\Helpers\Constant::IN_PROCESS)
                                                        <span class="badge badge-light-primary">{{ $happen_auction_detail->status }} </span>
                                                        @elseif ($happen_auction_detail->status == App\Helpers\Constant::COMPLETED)
                                                        <span class="badge badge-light-success">{{ $happen_auction_detail->status }} </span>
                                                        @elseif ($happen_auction_detail->status == App\Helpers\Constant::NEW)
                                                        <span class="badge badge-light-secondary">{{ $happen_auction_detail->status }} </span>
                                                        @elseif ($happen_auction_detail->status == App\Helpers\Constant::WINNER_SELECTED)
                                                        <span class="badge badge-light-info">{{ $happen_auction_detail->status }} </span>
                                                        @elseif ($happen_auction_detail->status == App\Helpers\Constant::OTHER)
                                                        <span class="badge badge-light-dark">{{ $happen_auction_detail->status }} </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
