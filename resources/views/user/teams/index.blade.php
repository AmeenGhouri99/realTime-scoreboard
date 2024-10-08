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
                            <h5>Teams of the Tournaments</h5>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.teams.addTeams', request()->id) }}"><i data-feather='plus'></i></a>
                        </div>
                    </div>

                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            @include('flash::message')
                            {{-- @include('user.home_page_modal') --}}
                            <h4>Matches</h4>
                            <table class="table" style="overflow:scroll">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Tournament Name</th>
                                        <th>Team 1</th>
                                        <th>Team 2</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matches as $match)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $team->Team1Match }}</td> --}}
                                            <td>
                                                {{ $match->tournament->name }}
                                            </td>
                                            <td>
                                                {{ $match->team1->name }}
                                                <br>

                                                Players: {{ $match->team1->teamPlayers->count() }}
                                                <br>

                                                Add More
                                                <a href="{{ route('user.players.index', $match->team1->id) }}"><i
                                                        data-feather='plus-circle'></i></a>
                                            </td>
                                            <td>
                                                {{ $match->team2->name }}

                                                <br>
                                                Players: {{ $match->team2->teamPlayers->count() }}
                                                <br>
                                                Add More
                                                <a href="{{ route('user.players.index', $match->team2->id) }}"><i
                                                        data-feather='plus-circle'></i></a>
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('user.players.create', $match->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    Add Players</a> --}}
                                                <a href="{{ route('user.manage.match', $match->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    Match</a>

                                                <a href="{{ route('user.scoreboard.create', $match->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    ScoreBoard</a>
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
