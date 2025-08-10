@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                            <h5>Total Teams in {{ $tournament->name}} Tournament</h5>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.teams.matchesBetweenTeams', request()->id) }}">Matches</a>
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.add_tournament_teams', request()->id) }}"><i
                                    data-feather='plus'></i></a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($teams as $team)
                            <div class="col-12 col-md-6 col-lg-4">

                                <div class="card bg-secondary">
                                    <div class="card-body text-center">

                                        <div class="avatar avatar-xl bg-warning shadow">
                                            <div class="avatar-content">
                                                <h3>{{ $loop->iteration }}</h3>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="mb-1 text-white">{{ $team->name }}</h1>
                                            <p class="card-text m-auto w-75 text-white">
                                                Total Players: {{ $team->teamPlayers->count() }}
                                            </p>
                                            <a href="{{ route('user.teams.update', $team->id) }}"
                                                class="btn btn-primary btn-sm">Edit Team</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
    </div>
    <!--/ Academic Card -->
    </div>
    </section>

    </div>
    <!-- END: Content-->
@endsection
@push('js_scripts')
    <script>
        $(document).ready(function() {
            $('#shareProject').modal('show');
        });
    </script>
@endpush
