<!-- Custom Modal -->
<div id="customModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2>Add Ball Information</h2>

        <!-- Display Button Details -->
        <p id="buttonDetails" class="button-details"></p>

        <!-- Display Wide or No-Ball Runs -->
        <div id="wideRuns" class="wide-runs" style="display: none;"></div>

        <form action="{{ route('user.balls.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="runs">Additional Runs</label>
                <input type="number" id="runs" name="runs" class="form-input" required>
            </div>

            <div class="form-group">
                <label>Run Type</label><br>
                <input type="radio" id="from_bat" name="run_type" value="from_bat" required>
                <label for="from_bat">From Bat</label>

                <input type="radio" id="bye" name="run_type" value="bye">
                <label for="bye">Bye</label>

                <input type="radio" id="leg_bye" name="run_type" value="leg_bye">
                <label for="leg_bye">Leg Bye</label>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    function setBallResult(ballType) {
        // Check if the ballType is one of the specific types
        if (ballType === 'WD' || ballType === 'NB' || ballType === 'BYE' || ballType === 'LB') {
            // Get the modal and button details elements
            const modal = document.getElementById('customModal');
            const buttonDetails = document.getElementById('buttonDetails');
            const wideRuns = document.getElementById('wideRuns');
            const runsInput = document.getElementById('runs');

            // Set button details
            buttonDetails.innerText = `Ball Type: ${ballType}`;

            // Initialize runs scored to 0
            let runsScored = 0;

            // Determine runs based on ball type
            if (ballType === 'WD' || ballType === 'NB') {
                runsScored = 1; // Set initial runs for No Ball or Wide
                wideRuns.style.display = 'block'; // Show the wide runs container
                wideRuns.innerHTML = `Wide/No Ball Runs: <strong>${runsScored}</strong>`;
            } else {
                wideRuns.style.display = 'none'; // Hide the wide runs container
            }

            // Set the runs input value to the calculated runs
            runsInput.value = 0;

            // Open the modal
            modal.style.display = 'block';
        }

        // Close modal when clicking the close button
        document.getElementById('closeModalBtn').onclick = function() {
            document.getElementById('customModal').style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('customModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    }
</script>
