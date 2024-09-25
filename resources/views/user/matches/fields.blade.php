<div class="row">
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        {{-- @dd($match->team1_id) --}}
        <label for="team1_runs">Which Team Won the Toss</label>
        {{ html()->select('which_team_won_the_toss', ['' => 'Select', $match->team1_id => $match->team1->name, $match->team2_id => $match->team2->name])->class('form-control form-control-sm') }}
    </div>
    <input name="tournament_id" value="{{ $match->tournament_id }}" type="hidden">
    {{-- <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="elected_bat_first_or_ball_first">Elected to Bat or Ball First:</label>
        {{ html()->select('elected_bat_first_or_ball_first', ['' => 'Select'] + $teamsArray)->class('form-control form-control-sm') }}
    </div> --}}
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="elected_bat_first_or_ball_first">Elected to Bat or Ball First:</label>
        {{ html()->select('elected_to_bat', ['' => 'Select', $match->team1_id => $match->team1->name, $match->team2_id => $match->team2->name])->class('form-control form-control-sm') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="elected_bat_first_or_ball_first">Select Batting Team:</label>
        {{ html()->select('batting_team_id', ['' => 'Select', $match->team1_id => $match->team1->name, $match->team2_id => $match->team2->name])->class('form-control form-control-sm') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="elected_bat_first_or_ball_first">Total Overs:</label>
        {{ html()->number('total_overs')->class('form-control form-control-sm')->placeholder('e.g 20') }}
    </div>
    {{-- <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="team1_runs">Player 1 Name:</label>
        {{ html()->text('player1_name')->class('form-control form-control-sm')->placeholder('First Player Name ') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="team1_runs">Player 2 Name:</label>
        {{ html()->text('player2_name')->class('form-control form-control-sm')->placeholder('Second Player Name') }}
    </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="team1_runs">Runs:</label>
            {{ html()->number('team1_runs')->class('form-control form-control-sm')->placeholder('Team 1 Runs') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="team1_extras">Extras:</label>
            {{ html()->number('team1_extras')->class('form-control form-control-sm')->placeholder('Team 1 Extras') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="bowler_name">Bowler Name:</label>
            {{ html()->text('bowler_name')->class('form-control form-control-sm')->placeholder('Bowler Name') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="bowler_overs">Bowler Overs:</label>
            {{ html()->number('bowler_overs')->class('form-control form-control-sm')->placeholder('Bowler Overs') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_overs">Total Overs:</label>
            {{ html()->number('total_overs')->class('form-control form-control-sm')->placeholder('Total Overs') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="bowler_runs">Bowler Runs:</label>
            {{ html()->number('bowler_runs')->class('form-control form-control-sm')->placeholder('Bowler Runs') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_fours_team1">Total Fours:</label>
            {{ html()->number('total_fours_team1')->class('form-control form-control-sm')->placeholder('Total Fours Team 1') }}
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_sixes_team1">Total Sixes:</label>
            {{ html()->number('total_sixes_team1')->class('form-control form-control-sm')->placeholder('Total Sixes Team 1') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_fours_team2">Total Fours:</label>
            {{ html()->number('total_fours_team2')->class('form-control form-control-sm')->placeholder('Total Fours Team 2') }}
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_sixes_team2">Total Sixes:</label>
            {{ html()->number('total_sixes_team2')->class('form-control form-control-sm')->placeholder('Total Sixes Team 2') }}
        </div>

        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_wickets_team1">Total Wickets Team 1:</label>
            {{ html()->number('total_wickets_team1')->class('form-control form-control-sm')->placeholder('Total Wickets Team 1') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="total_wickets_team2">Total Wickets Team 2:</label>
            {{ html()->number('total_wickets_team2')->class('form-control form-control-sm')->placeholder('Total Wickets Team 2') }}
        </div>
        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <label for="which_player_on_strike">Which Player On Strike:</label>
            {{ html()->select('which_player_on_strike')->class('form-control form-control-sm') }}
        </div> --}}
    <div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
        {{ html()->button('Save Match')->type('submit')->class('btn btn-primary') }}
    </div>
</div>
