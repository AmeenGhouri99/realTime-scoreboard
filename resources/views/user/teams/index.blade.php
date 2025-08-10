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

                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            @include('flash::message')
                            {{-- @include('user.home_page_modal') --}}
                            <h4>{{$tournament->name}} Teams</h4>
                            <table class="table" style="overflow:scroll">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        {{-- <th>Tournament Name</th> --}}
                                        <th>Team Name</th>
                                        <th>Players in Team</th>
                                        {{-- <th>Team 2</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teams as $team)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $team->Team1Match }}</td> --}}
                                            {{-- <td>
                                                {{ $team->tournament->name }}
                                            </td> --}}
                                            <td>
                                                {{ $team->name }}
                                            </td>
                                            <td>
                                                {{$team->teamPlayers->count()}}
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <a
                                                            href="{{ route('user.players.index', $team->id) }}"
                                                            class="btn btn-success btn-sm">Add player</a>
                                                        <a
                                                            href="{{ route('user.teams.update', $team->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @endif --}}
                                </tbody>
                            </table>
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
