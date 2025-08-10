@extends('user.layouts.main')
@section('content')
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <div class="col-xl-12 col-md-6 col-12">
                    <h5>Select Bowler</h5>
                    @include('flash::message')
                    {{ html()->modelForm($scoreboard, 'PUT', route('user.scoreboard.update', $scoreboard->id))->attribute('enctype', 'multipart/form-data')->open() }}

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                {{-- <th>Sr#</th> --}}
                                <th>Player Name</th>
                                <th>Team Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($players as $player)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="bowler_id" value="{{ $player->id }}"
                                            class="player-checkbox">
                                    </td>
                                    {{-- <td>{{ $loop->iteration }}</td> --}}
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->team->name }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row mt-1">
                        <div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
                            <input type="submit" name="submit" value="Save" class="btn btn-success btn-sm" />
                            <a href="{{ request()->back }}" class="btn btn-secondary btn-sm"><i
                                    data-feather='arrow-left'></i>Back</a>
                        </div>
                    </div>
                    {{ html()->form()->close() }}

                </div>
            </div>
        </section>
    </div>
@endsection

@push('js_scripts')
    <script>
        $(document).ready(function() {
            var selectedBowler = 1;
            var selectedPlayers = [];

            // Listen for changes on player checkboxes
            $('input.player-checkbox').on('change', function() {
                // Get the list of currently selected players
                selectedPlayers = $('input.player-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                // If we've reached the required number of players
                if (selectedPlayers.length === selectedBowler) {
                    // Disable remaining unchecked checkboxes
                    $('input.player-checkbox:not(:checked)').prop('disabled', true);

                    // Show modal to select who is on strike
                    // $('#playerOnStrike').empty(); // Clear previous options
                    // selectedPlayers.forEach(function(playerId) {
                    //     var playerName = $('input[value="' + playerId + '"]').closest('tr').find(
                    //         'td:eq(2)').text();
                    //     $('#playerOnStrike').append('<option value="' + playerId + '">' +
                    //         playerName + '</option>');
                    // });

                    // $('#strikeSelectionModal').modal('show');
                } else {
                    // Enable all checkboxes if less than required are selected
                    $('input.player-checkbox').prop('disabled', false);
                }
            });

            // Handle strike selection form submission
            // $('#strikeSelectionForm').on('submit', function(event) {
            //     event.preventDefault();
            //     var playerOnStrike = $('#playerOnStrike').val();
            //     console.log("Player on Strike:", playerOnStrike);
            //     $('#strikeSelectionModal').modal('hide');
            // });

            // Initially enable all checkboxes if no players are selected
            if (selectedPlayers.length < selectedBowler) {
                $('input.player-checkbox').prop('disabled', false);
            }
        });
    </script>
@endpush
