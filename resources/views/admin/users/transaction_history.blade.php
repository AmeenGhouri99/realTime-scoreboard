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
                                <h2 class="content-header-title float-start mb-0">{{ __('general.transaction_history') }}
                                </h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> --}}
                                        <li class="breadcrumb-item"><a href="#">{{ __('general.Users') }}</a></li>
                                        <li class="breadcrumb-item active">{{ __('general.transaction_history') }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                        <div class="mb-1 breadcrumb-right">
                            <a class="dt-button create-new btn btn-primary" href="{{ route('admin.users.index') }}"><i
                                    data-feather='arrow-left'></i></a>
                        </div>
                    </div>
                </div>
                <!-- Bread Crumb END-->

                <div class="card p-2">

                    <!-- Add Product Form START -->
                    <!-- Add Image Section END -->
                    {{-- {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'patch', 'files' => true,'onsubmit'=> 'process(event)']) !!} --}}
                    <div class="row mb-2 mt-2">
                        @include('flash::message')
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="list-group">
                                        <h3 href="#" class="list-group-item list-group-item-action active">
                                            {{ $user->first_name . ' ' . $user->last_name }}</h3>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#sr</th>
                                                            <th>Amount</th>
                                                            <th>Transaction Type</th>
                                                            <th>Description</th>
                                                            <th>Name</th>
                                                            <th>Created At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($transactions as $transaction)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $transaction->amount / 100 }}</td>
                                                                <td>{{ $transaction->type }}</td>
                                                                <td>
                                                                    @if (isset($transaction->meta['description']))
                                                                        {{ $transaction->meta['description'] }}
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                    </td>
                                                                <td> {{ $transaction->payable->first_name . ' ' . $transaction->payable->last_name }}
                                                                </td>
                                                                <td>{{ $transaction->created_at }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-2 col-sm-12 fw-bold">#sr</div>
                                            <div class="col-lg-2 col-sm-12 fw-bold">Amount</div>
                                            <div class="col-lg-2 col-sm-12 fw-bold">Transaction Type</div>
                                            <div class="col-lg-2 col-sm-12 fw-bold">
                                               Description
                                            </div>
                                            <div class="col-lg-2 col-sm-12 fw-bold">
                                                Name
                                             </div>
                                            <div class="col-lg-2 col-sm-12 fw-bold">Created At</div>
                                        </div>

                                    @foreach ($transactions as $transaction)
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="row">
                                                <div class="col-lg-2 col-sm-12">{{ $loop->iteration}}</div>
                                                <div class="col-lg-2 col-sm-12">{{  $transaction->amount/100}}</div>
                                                <div class="col-lg-2 col-sm-12">{{ $transaction->type}}</div>
                                                <div class="col-lg-2 col-sm-12">
                                                    @if (isset($transaction->meta['description']))
                                                        {{ $transaction->meta['description'] }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                                <div class="col-lg-2 col-sm-12">{{ $transaction->payable_id}}</div>

                                                <div class="col-lg-2 col-sm-12">{{ $transaction->created_at}}</div>
                                            </div>
                                        </a>
                                    @endforeach --}}
                                        {{-- </div>
                            </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- Script Code END -->
@endsection
