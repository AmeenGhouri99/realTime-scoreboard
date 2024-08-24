@extends('components.layouts.app')

@section('content')
    <div class="container mt-5">
        {{-- <h3>Match Dashboard - Overs Left: {{ $overs_left }}</h3> --}}

        <div class="mb-3">
            <label for="battingTeamSelect" class="form-label">Batting Team:</label>
            <select id="battingTeamSelect" class="form-select" wire:model="batting_team_id">
                <option value="">Select Batting Team</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="bowlerSelect" class="form-label">Bowler:</label>
            <select id="bowlerSelect" class="form-select" wire:model="current_bowler_id">
                <option value="">Select Bowler</option>
                @foreach ($bowlers as $bowler)
                    <option value="{{ $bowler->id }}">{{ $bowler->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="batsmanSelect" class="form-label">Batsman:</label>
            <select id="batsmanSelect" class="form-select" wire:model="current_batsman_id">
                <option value="">Select Batsman</option>
                @foreach ($batsmen as $batsman)
                    <option value="{{ $batsman->id }}">{{ $batsman->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Other parts of the form -->

        <div class="mt-3">
            <button class="btn btn-primary" wire:click="addBall">Add Ball</button>
        </div>

        <!-- Ball History Section -->
    </div>
@endsection
