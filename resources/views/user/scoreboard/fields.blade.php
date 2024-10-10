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
<div id="customModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>Add Ball Information</h2>

        <!-- Display Button Details -->
        <p id="buttonDetails" class="button-details"></p>

        <!-- Display Wide or No-Ball Runs -->
        <div id="wideRuns" class="wide-runs" style="display: none;"></div>

        {{-- <form action="{{ route('user.balls.store') }}" method="POST">
            @csrf --}}
        <div class="form-group">
            <label for="runs">Additional Runs</label>
            <input type="number" id="runs" name="runs" class="form-input" required>
        </div>

        <div class="form-group" id="no-ball_fields" style="display: none">
            <label>Run Type</label><br>
            <input type="radio" id="from_bat" name="run_type" value="from_bat" required>
            <label for="from_bat">From Bat</label>

            <input type="radio" id="bye" name="run_type" value="bye">
            <label for="bye">Bye</label>

            <input type="radio" id="leg_bye" name="run_type" value="leg_bye">
            <label for="leg_bye">Leg Bye</label>
        </div>

        <div class="form-group">
            <button type="button" id="modalSubmitBtn" class="btn btn-primary">Submit</button>
        </div>
        {{-- </form> --}}
    </div>
</div>
<input type="hidden" id="result_type">

<script>
    // Function to open the modal for wide, no-ball, bye, leg-bye
    function setBallResult(result) {
        // $('#runs').empty();
        function clearModalInputs() {
            document.getElementById('runs').value = ''; // Clear the runs input
            // document.getElementById('ball_extras').value = ''; // Clear the extras input
        }
        if (result === 'WD' || result === 'NB' || result === 'BYE' || result === 'LB') {
            clearModalInputs();
            $('#no-ball_fields').hide();

            if (result === 'NB') {
                $('#no-ball_fields').show();
            }
            // Initialize runs scored to 0
            let runsScored = 0;

            // Determine runs based on ball type
            if (result === 'WD' || result === 'NB') {
                runsScored = 1; // Set initial runs for No Ball or Wide
                wideRuns.style.display = 'block'; // Show the wide runs container
                wideRuns.innerHTML = `Wide/No Ball Runs: <strong>${runsScored}</strong>`;
            } else {
                wideRuns.style.display = 'none'; // Hide the wide runs container
            }

            // Set the runs input value to the calculated runs
            // runsInput.value = 0;

            // Open the modal
            // modal.style.display = 'block';
            $('#customModal').show(); // Show the modal
            $('#result_type').val(result); // Store result type
        } else {
            sendScoreUpdate(result, null, null); // Handle regular results
        }
    }

    // Close the modal when the close button is clicked
    $('#closeModalBtn').click(function() {
        $('#customModal').hide(); // Hide modal on close
    });

    // Function to send the AJAX request
    function sendScoreUpdate(result, additional_runs, run_type) {
        var formData = {
            striker_batsman_id: $('#striker_batsman_id').val(),
            non_striker_batsman_id: $('#non_striker_batsman_id').val(),
            bowler_id: $('#bowler_id').val(),
            scoreboard_id: $('#scoreboard_id').val(),
            innings_id: $('#innings_id').val(),
            ball_result: result,
            additional_runs: additional_runs,
            run_type: run_type,
            _token: "{{ csrf_token() }}",


            // Include the run type in the request
        };
        console.log(formData)
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
            url: "{{ route('user.balls.store') }}", // Ensure this is inside Blade template tags
            type: 'POST',
            data: formData,

            success: function(response) {
                alert('Score updated successfully!');
                $('#customModal').hide();
            },
            error: function(error) {
                alert('Error updating score!');
            }
        });
    }

    // Handle modal form submission
    $('#modalSubmitBtn').click(function() {
        // Get the additional runs and run type
        var additional_runs = $('#runs').val();
        var result_type = $('#result_type').val();
        var run_type = $('input[name="run_type"]:checked').val(); // Get the selected run type

        if (!additional_runs || !run_type) {
            alert('Please enter additional runs and select a run type');
            return;
        }

        // Send score update with additional runs, result type, and run type
        sendScoreUpdate(result_type, additional_runs, run_type);
    });
</script>



{{-- @include('user.scoreboard.modal') --}}

{{-- @endpush --}}
