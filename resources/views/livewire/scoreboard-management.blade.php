@extends('components.layouts.app')

@section('content')
    <div>
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Update Scoreboard</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveScore">
                        <div class="row">
                            <!-- Team 1 Score -->
                            <div class="col-md-4">
                                <h5>Team 1: {{ $team1->name }}</h5>
                                <div class="form-group">
                                    <label for="team1_runs">Runs</label>
                                    <input type="number" id="team1_runs" wire:model="team1_runs" class="form-control"
                                        placeholder="Enter runs">
                                </div>
                                <div class="form-group">
                                    <label for="team1_wickets">Wickets</label>
                                    <input type="number" id="team1_wickets" wire:model="team1_wickets" class="form-control"
                                        placeholder="Enter wickets">
                                </div>
                                <div class="form-group">
                                    <label for="team1_overs">Overs</label>
                                    <input type="text" id="team1_overs" wire:model="team1_overs" class="form-control"
                                        placeholder="Enter overs">
                                </div>
                            </div>
                            <!-- Team 2 Score -->
                            <div class="col-md-4">
                                <h5>Team 2: {{ $team2->name }}</h5>
                                <div class="form-group">
                                    <label for="team2_runs">Runs</label>
                                    <input type="number" id="team2_runs" wire:model="team2_runs" class="form-control"
                                        placeholder="Enter runs">
                                </div>
                                <div class="form-group">
                                    <label for="team2_wickets">Wickets</label>
                                    <input type="number" id="team2_wickets" wire:model="team2_wickets" class="form-control"
                                        placeholder="Enter wickets">
                                </div>
                                <div class="form-group">
                                    <label for="team2_overs">Overs</label>
                                    <input type="text" id="team2_overs" wire:model="team2_overs" class="form-control"
                                        placeholder="Enter overs">
                                </div>
                            </div>
                            <!-- Player Performance -->
                            <div class="col-md-4">
                                <h5>Update Player Performance</h5>
                                <div class="form-group">
                                    <label for="batsman1_name">Batsman Name</label>
                                    <select id="batsman1_name" wire:model="batsman1_name" class="form-control">
                                        <option value="">Select Batsman</option>
                                        @foreach ($battingTeamPlayers as $player)
                                            <option value="{{ $player->name }}">{{ $player->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="batsman1_runs">Runs</label>
                                    <input type="number" id="batsman1_runs" wire:model="batsman1_runs" class="form-control"
                                        placeholder="Enter runs">
                                </div>
                                <div class="form-group">
                                    <label for="batsman1_balls">Balls Faced</label>
                                    <input type="number" id="batsman1_balls" wire:model="batsman1_balls"
                                        class="form-control" placeholder="Enter balls faced">
                                </div>
                                <div class="form-group">
                                    <label for="bowler_name">Bowler Name</label>
                                    <select id="bowler_name" wire:model="bowler_name" class="form-control">
                                        <option value="">Select Bowler</option>
                                        @foreach ($bowlingTeamPlayers as $player)
                                            <option value="{{ $player->name }}">{{ $player->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bowler_wickets">Wickets</label>
                                    <input type="number" id="bowler_wickets" wire:model="bowler_wickets"
                                        class="form-control" placeholder="Enter wickets">
                                </div>
                                <div class="form-group">
                                    <label for="bowler_runs">Runs Conceded</label>
                                    <input type="number" id="bowler_runs" wire:model="bowler_runs" class="form-control"
                                        placeholder="Enter runs conceded">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Scoreboard</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
