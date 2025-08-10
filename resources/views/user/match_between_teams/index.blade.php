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
                            <h5>Total Matches in <b>{{$tournament->name}}</b> Tournament</h5>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.teams.addTeamsForMatch', request()->id) }}">Create A Match</a>
                        </div>
                    </div>

                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            @include('flash::message')
                            {{-- @include('user.home_page_modal') --}}
                            <h4>{{$tournament->name}} Matches</h4>
                            <table class="table" style="overflow:scroll">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        {{-- <th>Tournament Name</th> --}}
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
                                            {{-- <td>
                                                {{ $match->tournament->name }}
                                            </td> --}}
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
                                                <form action="{{ route('user.matches.destroy', $match->id) }}"
                                                    method="POST" style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this match?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger p-0 m-0 align-baseline"
                                                        style="text-decoration: none;">
                                                        <i data-feather='delete'></i>
                                                    </button>
                                                </form>
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
