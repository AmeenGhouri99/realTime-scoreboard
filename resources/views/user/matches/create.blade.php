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
                            href="{{ route('user.manage.match', $match->id) }}">Manage Match</a>
                    </li>
                    @if ($match->batting_team_id !== null)
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-outline-success {{ Route::CurrentRouteNamed('user.scoreboard.create') ? 'btn-success' : null }}"
                                href="{{ route('user.scoreboard.create', $match->id) }}">Scoreboard</a>
                        </li>
                    @endif
                @endsection
                <h3>Manage Match</h3>
                {{-- <ul style="color: red">
                        <li>Manage Match </li>
                        <li></li>
                    </ul> --}}
                <div class="card card-statistics">
                    <div class="card-body statistics-body">
                        @include('flash::message')
                        {{ html()->modelForm($match, 'PUT', route('user.matches.update', $match->id))->attribute('enctype', 'multipart/form-data')->open() }}
                        @include('user.matches.fields')
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
