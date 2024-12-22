@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <h3>Create Team</h3>
                    <ul style="color: red">
                        <li>Below is the Creating Teams details</li>
                        <li></li>
                    </ul>
                    {{-- <div class="card card-statistics">
                        <div class="card-body statistics-body"> --}}
                    @include('flash::message')
                    {{-- {!! html()->form('POST', route('user.teams.store'))->attribute('enctype', 'multipart/form-data')->open() !!} --}}
                    @include('user.match_between_teams.fields')
                    {{-- {{ html()->form()->close() }} --}}
                    {{-- </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection
