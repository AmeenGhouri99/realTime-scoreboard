<div class="row">
    <div class="col-sm-12">
        <h6><b>Match :</b> {{ $scoreboard->match->team1->name }} Vs {{ $scoreboard->match->team2->name }}</h6>

        <h6><b> Batting Team :</b> {{ $scoreboard->team->name }}</h6>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="first_player_name">First Player Name</label>
        {{ html()->text('first_player_name')->class('form-control form-control-sm')->placeholder('First Player Name') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="second_player_name">Second Player Name</label>
        {{ html()->text('second_player_name')->class('form-control form-control-sm')->placeholder('Second Player Name') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="first_player_runs">First Player Runs</label>
        {{ html()->number('first_player_runs')->class('form-control form-control-sm')->placeholder('First Player Runs') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="second_player_runs">Second Player Runs</label>
        {{ html()->number('second_player_runs')->class('form-control form-control-sm')->placeholder('Second Player Runs') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="first_player_ball_faced">First Player Balls Faced</label>
        {{ html()->number('first_player_ball_faced')->class('form-control form-control-sm')->placeholder('Balls Faced by First Player') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="second_player_ball_faced">Second Player Balls Faced</label>
        {{ html()->number('second_player_ball_faced')->class('form-control form-control-sm')->placeholder('Balls Faced by Second Player') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="bowler_ball_faced">Bowler Name</label>
        {{ html()->text('bowler_name')->class('form-control form-control-sm')->placeholder('Bowler Name') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="bowler_ball_faced">Bowler Balls</label>
        {{ html()->number('bowler_ball_faced')->class('form-control form-control-sm')->placeholder('Bowler Balls Faced') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="bowler_overs">Bowler Overs</label>
        {{ html()->number('bowler_overs')->class('form-control form-control-sm')->placeholder('Bowler Overs') }}
    </div>

    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="bowler_runs">Bowler Runs</label>
        {{ html()->number('bowler_runs')->class('form-control form-control-sm')->placeholder('Bowler Runs') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="total_scores">Bowler Wickets</label>
        {{ html()->number('bowler_wickets')->class('form-control form-control-sm')->placeholder('bowler Wickets') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="extra">Extras</label>
        {{ html()->number('extra')->class('form-control form-control-sm')->placeholder('Extras') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="total_scores">Total wickets</label>
        {{ html()->number('total_wickets')->class('form-control form-control-sm')->placeholder('Total Wickets') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="total_scores">Total Scores</label>
        {{ html()->number('total_scores')->class('form-control form-control-sm')->placeholder('Total Scores') }}
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="total_scores">total Overs Done</label>
        {{ html()->number('overs_done')->class('form-control form-control-sm')->placeholder('total overs done') }}
    </div>
    {{-- <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="total_scores">Overs Done</label>
        {{ htm)->class('form-control form-control-sm')->placeholder('total overs done') }}
    </div> --}}
    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
        <label for="total_scores">Innings Status</label>
        {{ html()->select('innings', ['' => 'select innings', 'first innings' => '1st Innings', 'second innings' => '2nd Innings', 'draw' => 'draw'])->class('form-control form-control-sm') }}
    </div>
    <div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
        {{ html()->button('Save Match')->type('submit')->class('btn btn-primary') }}
    </div>
</div>
