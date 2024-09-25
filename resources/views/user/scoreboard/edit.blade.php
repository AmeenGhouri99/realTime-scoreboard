@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                @section('add_menu_items')
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-success {{ Route::CurrentRouteNamed('user.manage.match*') ? 'btn-success' : null }}"
                            href="{{ route('user.manage.match', $scoreboard->match_id) }}">Change Batting</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link btn btn-outline-success {{ Route::CurrentRouteNamed('user.scoreboard.create') ? 'btn-success' : null }}"
                            href="{{ route('user.scoreboard.create', $scoreboard->match_id) }}">Scoreboard</a>
                    </li>
                @endsection

                {{-- <h3>Manage Scores</h3>
                    <ul style="color: red">
                        <li>Manage scores</li>
                        <li></li>
                    </ul> --}}
                <div class="card card-statistics">
                    <div class="card-body statistics-body">
                        @include('flash::message')
                        {{-- @dd($match) --}}
                        {{ html()->modelForm($scoreboard, 'PUT', route('user.scoreboard.update', $scoreboard->id))->attribute('enctype', 'multipart/form-data')->open() }}
                        @include('user.scoreboard.fields')
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
