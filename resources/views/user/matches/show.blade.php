@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $match->tournament->name }}</h2>
                <h4>Match: {{ $match->team1->name }} vs {{ $match->team2->name }}</h4>

                <form id="updateMatchForm" method="POST" action="{{ route('matches.update', $match->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <h5>Team 1 Runs: {{ $match->team1->name }}</h5>
                        <input type="number" name="team1_runs" value="{{ $match->team1_runs }}" class="form-control">
                        <label for="team1_extras">Team 1 Extras</label>
                        <input type="number" name="team1_extras" value="{{ $match->team1_extras }}" class="form-control">
                        <label for="total_fours_of_team_1">Team 1 Fours</label>
                        <input type="number" name="total_fours_of_team_1" value="{{ $match->total_fours_of_team_1 }}"
                            class="form-control">
                        <label for="total_sixes_of_team_1">Team 1 Sixes</label>
                        <input type="number" name="total_sixes_of_team_1" value="{{ $match->total_sixes_of_team_1 }}"
                            class="form-control">
                        <label for="total_wickets_of_team1">Team 1 Wickets</label>
                        <input type="number" name="total_wickets_of_team1" value="{{ $match->total_wickets_of_team1 }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <h5>Team 2 Runs: {{ $match->team2->name }}</h5>
                        <input type="number" name="team2_runs" value="{{ $match->team2_runs }}" class="form-control">
                        <label for="team2_extras">Team 2 Extras</label>
                        <input type="number" name="team2_extras" value="{{ $match->team2_extras }}" class="form-control">
                        <label for="total_fours_of_team_2">Team 2 Fours</label>
                        <input type="number" name="total_fours_of_team_2" value="{{ $match->total_fours_of_team_2 }}"
                            class="form-control">
                        <label for="total_sixes_of_team_2">Team 2 Sixes</label>
                        <input type="number" name="total_sixes_of_team_2" value="{{ $match->total_sixes_of_team_2 }}"
                            class="form-control">
                        <label for="total_wickets_of_team2">Team 2 Wickets</label>
                        <input type="number" name="total_wickets_of_team2" value="{{ $match->total_wickets_of_team2 }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <h5>Players on the Field</h5>
                        <label for="firstPlayer">First Player</label>
                        <select id="firstPlayer" name="first_player_id" class="form-control" onchange="updateStrike()">
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}"
                                    {{ $player->id == optional($match->players->first())->player_id ? 'selected' : '' }}>
                                    {{ $player->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="secondPlayer">Second Player</label>
                        <select id="secondPlayer" name="second_player_id" class="form-control" onchange="updateStrike()">
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}"
                                    {{ $player->id == optional($match->players->last())->player_id ? 'selected' : '' }}>
                                    {{ $player->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="strikePlayer">Which Player is on Strike?</label>
                        <select id="strikePlayer" name="strike_player_id" class="form-control">
                            <option value="{{ optional($match->players->first())->player_id }}">
                                {{ optional($match->players->first())->player->name }}</option>
                            <option value="{{ optional($match->players->last())->player_id }}">
                                {{ optional($match->players->last())->player->name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <h5>Bowler</h5>
                        <label for="bowler">Bowler</label>
                        <select id="bowler" name="bowler_id" class="form-control">
                            @foreach ($bowlers as $bowler)
                                <option value="{{ $bowler->id }}"
                                    {{ $bowler->id == optional($match->bowlers->first())->bowler_id ? 'selected' : '' }}>
                                    {{ $bowler->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="bowlerOvers">Bowler Overs</label>
                        <input type="number" id="bowlerOvers" name="bowler_overs"
                            value="{{ optional($match->bowlers->first())->overs }}" step="0.1" class="form-control">

                        <label for="bowlerRuns">Bowler Runs Conceded</label>
                        <input type="number" id="bowlerRuns" name="bowler_runs"
                            value="{{ optional($match->bowlers->first())->runs_conceded }}" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateStrike() {
            const firstPlayer = document.getElementById('firstPlayer').value;
            const secondPlayer = document.getElementById('secondPlayer').value;
            const strikePlayer = document.getElementById('strikePlayer');

            strikePlayer.innerHTML = `
            <option value="${firstPlayer}">First Player</option>
            <option value="${secondPlayer}">Second Player</option>
        `;
        }
    </script>
@endsection
