<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Scoreboard</title>
    <link href="{{ asset('app-assets/css/scoreboard.css') }}" rel="stylesheet">
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>

</head>

<body>

    <!-- Header Section -->
    <div class="header">
        <span>LocalCricketLive</span>
        <div>
            <button class="btn btn-light">
                <i class="bi bi-gear"></i>
            </button>
        </div>
    </div>

    <!-- Current Score Section -->
    <div class="score-section">
        <h1>24/1 <small>(1.1/2)</small></h1>
        <p>CRR: 20.57 Projected Score: 41 (at 20.57 RPO)</p>
    </div>

    <!-- Players Info Section -->
    <div class="players-info">
        <!-- Player 1 (Batsman 1) -->
        <div class="player">
            <span
                class="{{ $scoreboard->player1->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike ? 'text-warning' : 'text-secondary' }}"
                id="first_player">
                {{ $scoreboard->player1->name }}
            </span>
            <p>0(0)</p>

            <!-- Hidden field to send batsman1 ID if on strike -->
            @if ($scoreboard->player1->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike)
                <input type="hidden" name="striker_batsman_id" id="striker_batsman_id"
                    value="{{ $scoreboard->player1->id }}">
            @else
                <input type="hidden" name="non_striker_batsman_id" id="non_striker_batsman_id"
                    value="{{ $scoreboard->player1->id }}">
            @endif
            <input type="hidden" name="scoreboard_id" id="scoreboard_id" value="{{ request()->id }}">

            <input type="hidden" name="innings_id" id="innings_id" value="{{ $scoreboard->id }}">
            <input type="hidden" name="innings_id" id="bowler_id" value="{{ $scoreboard->bowler_id }}">
        </div>

        <!-- Player 2 (Batsman 2) -->
        <div class="player">
            <span
                class="{{ $scoreboard->player2->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike ? 'text-warning' : 'text-secondary' }}"
                id="second_player">
                {{ $scoreboard->player2->name }}
            </span>
            <p>0(0)</p>

            <!-- Hidden field to send batsman2 ID if on strike -->
            @if ($scoreboard->player2->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike)
                <input type="hidden" name="striker_batsman_id" id="striker_batsman_id"
                    value="{{ $scoreboard->player2->id }}">
            @else
                <input type="hidden" name="non_striker_batsman_id" id="non_striker_batsman_id"
                    value="{{ $scoreboard->player2->id }}">
            @endif
        </div>
    </div>


    <!-- Bowler Info Section -->
    <div class="players-info">
        <div class="player">
            <span class="text-secondary" id="bowler">Adam Baker</span>
            <p>0.1-0-0-1</p>
            <div class="bowler-info">
                <span class="bowler-result">Wicket</span> <!-- Bowler current over result here -->
            </div>
        </div>
        <div class="cao-btn">CAO</div> <!-- CAO Catch Out -->
    </div>

    <!-- Score Input Section -->
    <div class="container">
        <div class="action-buttons">
            <button type="button" class="btn btn-dark" onclick="setBallResult(0)">0</button>
            <button type="button" class="btn btn-dark" onclick="setBallResult(1)">1</button>
            <button type="button" class="btn btn-dark" onclick="setBallResult(2)">2</button>
            <button type="button" class="btn btn-dark" onclick="setBallResult(3)">3</button>
            <button type="button" class="btn btn-warning" onclick="setBallResult(4)">4</button>
            <button type="button" class="btn btn-danger" onclick="setBallResult(6)">6</button>
            <button type="button" class="btn btn-danger" onclick="setBallResult('OUT')">OUT</button>
            <button type="button" class="btn btn-dark undo-btn" onclick="setBallResult('undo')">UNDO</button>
        </div>
        <div class="action-buttons mt-2">
            <button type="button" class="btn btn-dark" onclick="setBallResult('WD')">WD</button>
            <button type="button" class="btn btn-dark" onclick="setBallResult('NB')">NB</button>
            <button type="button" class="btn btn-dark" onclick="setBallResult('BYE')">BYE</button>
            <button type="button" class="btn btn-dark" onclick="setBallResult('LB')">LB</button>
        </div>
    </div>


</body>

</html>
{{-- <div class="row">
    <div class="col-sm-12">
        <h6><b>Match :</b> {{ $scoreboard->match->team1->name }} Vs {{ $scoreboard->match->team2->name }}</h6>
        <h6><b> Batting Team :</b> {{ $scoreboard->team->name }}</h6>
    </div>
    <div class="col-sm-12">
        <h6><b>First Player :</b> {{ $scoreboard->match->team1->name }} Vs {{ $scoreboard->match->team2->name }}</h6>
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
{{-- @push('js_scripts') --}}
<script>
    // Function to handle ball results
    function setBallResult(result) {
        // Test: Log the result to see if the function is called
        var striker_batsman_id = $('#striker_batsman_id').val();
        var non_striker_batsman_id = $('#non_striker_batsman_id').val();
        var bowler_id = $('#bowler_id').val();
        var innings_id = $('#innings_id').val();
        var scoreboard_id = $('#scoreboard_id').val();


        // console.log("Ball Result:", result + "Batsman_id", batsman_id);

        // Prepare the data to send (you can adjust this based on your needs)
        const data = {
            ball_result: result,
            striker_batsman_id: striker_batsman_id,
            non_striker_batsman_id: non_striker_batsman_id,

            innings_id: innings_id,
            bowler_id: bowler_id,
            scoreboard_id: scoreboard_id,
            _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
        };

        // Make AJAX POST request
        $.ajax({
            url: '{{ route('user.balls.store') }}', // Laravel route
            type: 'POST',
            data: data,
            success: function(response) {
                // Handle success
                console.log(response.data)
                $.each(response.data, function(index, scoreboard) {
                    // alert(scoreboard);
                });

                alert('Ball result updated successfully: ' + response);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Log the error response for more details
                alert('Error updating ball result: ' + error);
            }
        });
    }
</script>
{{-- @endpush --}}
