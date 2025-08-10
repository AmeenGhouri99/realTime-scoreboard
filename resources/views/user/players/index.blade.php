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
                            <h5>{{$team->name}} Team Dashboard</h5>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.teams.matchesBetweenTeams', $team->tournament_id) }}">Matches</a>
                                <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.teams.teamsOfTournament', $team->tournament_id) }}">Teams</a>
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.players.create', request()->id) }}"><i data-feather='plus'></i></a>
                        </div>
                    </div>
                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            {{-- <h4>Add New Player</h4> --}}
                            @include('flash::message')
                            {!! html()->form('POST', route('user.players.store'))->attribute('enctype', 'multipart/form-data')->open() !!}
                            @include('user.players.fields', [
                                'team' => $team,
                            ])
                            {{ html()->form()->close() }}

                            {{-- @include('user.home_page_modal') --}}
                            <h4 class="mt-1"> {{$team->name}} Total Players</h4>
                            <table class="table" style="overflow:scroll">
                                <thead>
                                    <tr>
                                        {{-- <th>Select</th> --}}
                                        <th>Sr#</th>
                                        <th>Player Name</th>
                                        {{-- <th>Team Name</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($players->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="8">You have Not add any of Player in {{$team->name}} Team</td>
                                        </tr>
                                    @else
                                        @foreach ($players as $player)
                                            <tr>
                                                {{-- <td><input type="checkbox" name="player_id[]" value="{{ $player->id }}">
                                                </td> --}}
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $player->name }}</td>
                                                {{-- <td>{{ $player->team->name }}</td> --}}

                                                <td>
                                                    <div class="row">
                                                        <div class="col-3"><a
                                                                href="{{ route('user.players.edit', $player->id) }}"><i
                                                                    data-feather='edit-3'></i>
                                                            </a>
                                                            <form action="{{ route('user.players.delete', $player->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <a href=""><i data-feather='delete'
                                                                        style="color:red"></i></a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
