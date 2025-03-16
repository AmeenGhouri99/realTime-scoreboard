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
        <h1><span id="batting_team_score"></span>/<span id="batting_team_out"></span> <small>(<span
                    id="running_over"></span> <span id="total_overs"></span>)</small></h1>
        <p>CRR: 20.57 Projected Score: 41 (at 20.57 RPO)</p>
    </div>
    {{-- <span id="first_player_runs"></span> --}}

    <input type="hidden" id="striker_batsman_id">
    <input type="hidden" id="non_striker_batsman_id">
    {{-- @dd(request()->id) --}}
    <input type="hidden" name="scoreboard_id" id="scoreboard_id" value="{{ request()->id }}">
    {{-- @dd($scoreboard) --}}
    <input type="hidden" name="innings_id" id="innings_id" value="{{ $scoreboard->id }}">
    <input type="hidden" name="innings_id" id="bowler_id" value="{{ $scoreboard->bowler_id }}">
    <!-- Players Info Section -->
    <!-- Players Info Section -->
    <div class="players-info">
        <!-- Player 1 (Batsman 1) -->
        <div class="player">
            <span id="first_player_name" class="player-name">
                {{ $scoreboard->player1->name }}
            </span>
            <span id="player1_stats"></span>
        </div>

        <!-- Player 2 (Batsman 2) -->
        <div class="player">
            <span id="second_player_name" class="player-name">
                {{ $scoreboard->player2->name }}
            </span>
            {{-- <p id="player2_stats"></p> --}}
            <span id="player2_stats"></span>
        </div>
    </div>


    <!-- Bowler Info Section -->
    <div class="players-info">
        <div class="player">
            <span class="text-secondary" id="bowler_name"></span>
            <span class="text-secondary" id="bowler_name"></span>
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
        $.ajax({
            url: "{{ route('user.balls.store') }}", // Ensure this is inside Blade template tags
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.redirect_url) {
                    // Perform the redirect if a redirect URL is provided
                    window.location.href = response.redirect_url;
                } else {
                    // Handle the success response, such as updating the UI
                    alert('Score updated successfully!');
                    console.log(response);
                    $('#customModal').hide();
                    // Call a function to update the scoreboard UI with new data
                    updateScoreboard(response);
                }
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
        var run_type = $('input[name="run_type"]:checked').val();
        // alert(run_type) // Get the selected run type
        if (result_type === 'NB') {
            if (!run_type) {
                alert('select a run type');
                return;
            }
        }
        if (!additional_runs) {
            alert('Please enter additional runs');
            return;
        }

        // Send score update with additional runs, result type, and run type
        sendScoreUpdate(result_type, additional_runs, run_type);
    });
</script>
<script>
    var sseSource = new EventSource("/scoreBoard/" +
        {{ request()->id }});

    sseSource.onmessage = function(event) {
        let eventData = JSON.parse(event.data)
        console.log('this is the event data = ' + eventData)
        $('#first_player_name').text(eventData.player1 ?? "Unknown Player");
        $('#second_player_name').text(eventData.player2 ?? "Unknown Player");


        // $('#batting_team_name').text(eventData.batting_team_name)
        $('#player1_stats').text(eventData.player1_stats ?? 0)
        $('#first_player_ball_faced').text(eventData.player1_ball_faced ?? 0)
        $('#player2_stats').text(eventData.player2_stats ?? 0)
        $('#second_player_ball_faced').text(eventData.player2_ball_faced ?? 0)
        $('#batting_team_score').text(eventData.total_runs ?? 0)
        $('#batting_team_out').text(eventData.total_wickets ?? 0)
        $('#running_over').text(eventData.total_overs_done ?? 0)
        $('#total_overs').text(eventData.data.total_overs ?? 0)
        $('#extras').text(eventData.scoreboard.extra ?? 0)
        $('#bowler_name').text(eventData.bowler_name ?? "Unknown Bowler")
        $('#bowler_runs').text(eventData.scoreboard.bowler_runs ?? 0)
        $('#bowler_overs').text(eventData.scoreboard.bowler_overs ?? 0)
        $('#bowler_ball_faced, #current_over_balls').text(eventData.scoreboard.bowler_ball_faced ?? 0)
        $('#target').text(eventData.target)
        $('#bowling_team_name').text(eventData.bowling_team_name)
        $('#target_message').text(eventData.target_message)
        $('#bowler_wickets').text(eventData.scoreboard.bowler_wickets ?? 0)
        $('#batting_team_name,#batting_team').text(eventData.batting_team_name)
        $('#striker_batsman_id').val(eventData.striker_player_id)
        $('#non_striker_batsman_id').val(eventData.non_striker_player_id)

        console.log('Player 1 Stats:', eventData.player1_stats); // Highlight the striker
        const strikerId = eventData.striker_player_id; // Ensure this ID is provided by the backend
        if (strikerId == eventData.player1_id) {
            $('#first_player_name').addClass('text-warning').removeClass('text-secondary');
            $('#second_player_name').addClass('text-secondary').removeClass('text-warning');
        } else if (strikerId == eventData.player2_id) {
            $('#second_player_name').addClass('text-warning').removeClass('text-secondary');
            $('#first_player_name').addClass('text-secondary').removeClass('text-warning');
        }

    };

    sseSource.onerror = function(event) {
        if (sseSource.readyState === EventSource.CLOSED) {
            console.log("Attempting to reconnect...");
            establishSSEConnection();
        }
    };

    function establishSSEConnection() {
        var sseSource = new EventSource("/scoreBoard/" +
            {{ request()->id }});
    }
</script>



{{-- @include('user.scoreboard.modal') --}}

{{-- @endpush --}}
