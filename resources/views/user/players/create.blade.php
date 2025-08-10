@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <h3>Add A Player to {{ $team->name}}</h3>
                    <ul style="color: red">
                        <li>Add a Player Details here</li>
                        <li></li>
                    </ul>
                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            @include('flash::message')
                            {!! html()->form('POST', route('user.players.store'))->attribute('enctype', 'multipart/form-data')->open() !!}
                            @include('user.players.fields')
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
