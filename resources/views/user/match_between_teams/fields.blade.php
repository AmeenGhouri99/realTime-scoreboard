<div class="row">
    <label for="name">Select Two Teams Here:</label>
    @foreach ($teams as $key => $team)
        <div class="col-xl-3 col-sm-6 col-12 mb-xl-0">
            <div class="card team-card" onclick="toggleCheckbox(this)">
                <div class="card-body position-relative">
                    <h6>
                        <input type="checkbox" class="team-checkbox d-none" value="{{ $key }}" name="team_id[]">
                        <span class="p-1">{{ $team }}</span>
                    </h6>
                    <!-- Tick mark -->
                    <div class="tick-mark position-absolute top-0 end-0" style="display: none;">
                        <svg width="24" height="24" fill="green" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path d="M9 16.2l-3.5-3.5 1.4-1.4 2.1 2.1 5.6-5.6 1.4 1.4-7 7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<input type="hidden" value="{{ $tournament->id }}" name="tournament_id">

<div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
    <a href="{{ url('home') }}" class="btn btn-primary"><i data-feather='arrow-left'></i>Back</a>
    <input type="submit" name="submit" id="saveAndNext" value="Save & Go To Next" class="btn btn-success btn-sm" />
</div>

<script src="{{ asset('app-assets/js/sweet_alerts/swal_sweet_alerts.js') }}"></script>
@push('js_scripts')
    <script>
        function toggleCheckbox(card) {
            const checkbox = card.querySelector('.team-checkbox');
            const tickMark = card.querySelector('.tick-mark');

            // Skip if the checkbox is disabled
            if (checkbox.disabled) {
                return;
            }

            // Toggle checkbox checked state
            checkbox.checked = !checkbox.checked;

            // Show/hide tick mark based on checkbox state
            if (checkbox.checked) {
                tickMark.style.display = 'block';
            } else {
                tickMark.style.display = 'none';
            }

            // Update state for all checkboxes
            handleTeamSelection();
        }

        function handleTeamSelection() {
            const checkboxes = document.querySelectorAll('.team-checkbox');
            const selectedCheckboxes = Array.from(checkboxes).filter(cb => cb.checked);
            const selectedCount = selectedCheckboxes.length;

            // Enable/disable checkboxes based on the selection count
            checkboxes.forEach(cb => {
                if (selectedCount === 2) {
                    cb.disabled = !cb.checked; // Disable unchecked checkboxes
                } else {
                    cb.disabled = false; // Enable all checkboxes if less than 2 are selected
                }

                // Add/remove disabled style to cards
                const card = cb.closest('.team-card');
                if (cb.disabled && !cb.checked) {
                    card.classList.add('disabled-card');
                } else {
                    card.classList.remove('disabled-card');
                }
            });

            // Make AJAX request if two teams are selected
            if (selectedCount === 2) {
                const selectedTeams = selectedCheckboxes.map(cb => cb.value);
                sendSelectedTeams(selectedTeams);
            }
        }

        // JavaScript to handle the "Save and Next" button click event
        document.getElementById('saveAndNext').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form from submitting immediately

            let selectedTeams = [];
            document.querySelectorAll('.team-checkbox:checked').forEach(function(checkbox) {
                selectedTeams.push(checkbox.value); // Get the value (team ID) of each checked checkbox
            });

            // Debugging: Log selectedTeams array
            console.log('Selected Teams:', selectedTeams);

            let tournamentId = document.querySelector('input[name="tournament_id"]').value;

            // Check if two teams are selected
            if (selectedTeams.length !== 2) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please select exactly two teams.',
                    text: 'You must select two teams to proceed.',
                    confirmButtonText: 'OK'
                });
                return; // Exit the function if the number of selected teams is not 2
            }

            // AJAX request to send the selected teams and tournament ID
            fetch('{{ route('user.teams_match.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        team_ids: selectedTeams,
                        tournament_id: tournamentId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        // Success response
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const url =
                                    `{{ route('user.teams.matchesBetweenTeams', ['id' => '__tournament_id__']) }}`
                                    .replace('__tournament_id__', tournamentId);
                                window.location.href = url;
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
@endpush

<style>
    .team-card {
        cursor: pointer;
        border: 1px solid #ccc;
        transition: 0.3s;
    }

    .team-card:hover {
        border: 1px solid #007bff;
        background-color: #f8f9fa;
    }

    .team-card.selected {
        border: 2px solid green;
        background-color: #eaffea;
    }

    .team-card.disabled-card {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .tick-mark {
        top: 10px;
        right: 10px;
        display: none;
    }

    .team-card .team-checkbox:checked~.tick-mark {
        display: block;
    }
</style>
