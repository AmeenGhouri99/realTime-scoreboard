@extends('user.layouts.main')
@section('content')
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <div class="col-xl-12 col-md-6 col-12">
                    <h5>Select Batting Player</h5>
                    @include('flash::message')

                    {{-- Form --}}
                    {{-- @dd($scoreboard->id) --}}
                    {{ html()->modelForm($scoreboard, 'PUT', route('user.scoreboard.update', $scoreboard->id))->attribute('enctype', 'multipart/form-data')->id('scoreboardForm')->open() }}
                    <input type="hidden" value="{{ $previous_player }}" name="previous_player_id">
                    <input type="hidden" value="{{ $is_out }}" name="is_out">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Sr#</th>
                                <th>Player Name</th>
                                <th>Team Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($players as $player)
                                @php
                                    $playerStat = $player_stats->firstWhere('player_id', $player->id);
                                    $isPlayerOut = $playerStat?->is_out == 1;

                                @endphp
                                {{-- @dd($batsman_on_pitch_id) --}}
                                <tr>
                                    <td>
                                        @if ($isPlayerOut)
                                            <button class="btn btn-danger btn-sm"> OUT</button>
                                        @else
                                            <input type="checkbox" name="player_id[]" value="{{ $player->id }}"
                                                class="player-checkbox"
                                                {{ $player->id === $batsman_on_pitch_id ? 'checked' : '' }}>
                                        @endif
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->team->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mt-1">
                        <div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
                            <button type="submit" id="submitBtn" class="btn btn-success btn-sm">Save</button>
                            <a href="{{ request()->back }}" class="btn btn-secondary btn-sm"><i
                                    data-feather='arrow-left'></i>Back</a>
                        </div>
                    </div>

                    {{ html()->form()->close() }}
                </div>
            </div>
        </section>

        <!-- Modal for confirming players on strike -->
        <div class="modal fade" id="strikeSelectionModal" tabindex="-1" aria-labelledby="strikeSelectionLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="strikeSelectionLabel">Select Player on Strike</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="strikeSelectionForm" action="{{ route('user.players.change-strike', $scoreboard->id) }}"
                            method="post">
                            @csrf
                            @method('put')
                            <label for="playerOnStrike" class="form-label">Who is on strike?</label>
                            <select class="form-select" id="playerOnStrike" name="playerOnStrike">
                                <!-- Dynamically populated -->
                            </select>
                            <button type="submit" class="btn btn-primary mt-3">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_scripts')
    <script>
        $(document).ready(function() {
            var maxStrikesPlayers = {{ $count_batsman }};
            var selectedPlayers = [];

            // Disable players who are out
            @foreach ($players as $player)
                @php
                    $playerStat = $player_stats->firstWhere('player_id', $player->id);
                    $isPlayerOut = $playerStat?->is_out == 1;
                @endphp
                @if ($isPlayerOut)
                    $('input[value="{{ $player->id }}"]').prop('disabled', true);
                @endif
            @endforeach

            // Intercept form submission
            $('#scoreboardForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // AJAX request to submit form data
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Show the modal on successful update
                        $('#strikeSelectionModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Submission failed:', error);
                        alert('Something went wrong. Please try again.');
                    }
                });
            });

            // Listen for changes on player checkboxes
            $('input.player-checkbox').on('change', function() {
                // Get the list of currently selected players
                selectedPlayers = $('input.player-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                // If we've reached the required number of players
                if (selectedPlayers.length === maxStrikesPlayers) {
                    // Disable remaining unchecked checkboxes
                    $('input.player-checkbox:not(:checked)').prop('disabled', true);

                    // Show modal to select who is on strike
                    $('#playerOnStrike').empty(); // Clear previous options
                    selectedPlayers.forEach(function(playerId) {
                        var playerName = $('input[value="' + playerId + '"]').closest('tr').find(
                            'td:eq(2)').text();
                        $('#playerOnStrike').append('<option value="' + playerId + '">' +
                            playerName + '</option>');
                    });
                } else {
                    // Enable all checkboxes, but make sure out players remain disabled
                    $('input.player-checkbox').prop('disabled', false);

                    // Disable players who are out again
                    $('input.player-checkbox').each(function() {
                        var playerId = $(this).val();
                        if ($(this).prop('checked') === false && !selectedPlayers.includes(
                                playerId)) {
                            $(this).prop('disabled', function() {
                                var playerStat = @json($player_stats->keyBy('player_id'));
                                return playerStat[playerId]?.is_out === 1;
                            });
                        }
                    });
                }
            });

            // Initially, disable checkboxes for out players
            $('input.player-checkbox').each(function() {
                var playerId = $(this).val();
                var playerStat = @json($player_stats->keyBy('player_id'));
                if (playerStat[playerId]?.is_out === 1) {
                    $(this).prop('disabled', true);
                }
            });
        });
    </script>
@endpush
