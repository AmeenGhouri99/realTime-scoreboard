<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Scoreboard</title>
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/custom.css') }}">
</head>

<body>
    {{-- @dd(asset('app/assets/style.css')); --}}
    <div class="container-fluid mt-5 scoreboard">
        <div class="content-align-center">
            <div class="row">
                <div class="col-1 shadow-lg team1">
                    <h6 class="mt-1" id="batting_team" style="color: #ffffff; text-shadow: 1px 1px 2px black;"></h6>
                </div>
                <div class="col-10 rounded-pill shadow-lg main-scoreboard">
                    <div class="row">
                        <div class="col-2 player1">
                            <span id="first_player_name" style="font-weight: bold"></span>
                            <span id="first_player_runs"></span>(<span id="first_player_ball_faced"></span>)
                        </div>
                        <div class="col-2 player2">
                            <span id="second_player_name" style="font-weight: bold"></span>
                            <span id="second_player_runs"></span>(<span id="second_player_ball_faced"></span>)
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="inner-scoreboard">
                                        <div class="row">
                                            <div class="col-4 text-end">
                                                <span id="batting_team_name" style="font-weight: bold;"></span>
                                            </div>
                                            <div class="col-4 text-left" style="font-weight: bold">
                                                <span id="batting_team_score"></span>
                                                /<span id="batting_team_out"></span>
                                            </div>
                                            <div class="col-4">
                                                <span style="font-size: 14px; font-weight:bold; margin-top:2px"> Ovs.
                                                    &nbsp</span><span id="running_over"
                                                    style="font-size: 14px; font-weight: bold;"></span>.<span
                                                    id="current_over_balls"
                                                    style="font-size: 14px; font-weight: bold;"></span>/<span
                                                    id="total_overs" style="font-size: 14px; font-weight: bold;"></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="score-need" style="font-weight: bold">
                                        <p class="text-center" id="target_message">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 extras">
                            <div class="row">
                                <div class="col-12">
                                    Extras <span id="extras"></span>
                                </div>
                                <div class="col-12">
                                    Target: <span id="target"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 bowler-info">
                            <div>
                                <span id="bowler_name"></span>
                                <span id="bowler_wickets"></span>-<span id="bowler_runs"></span>
                                (<span id="bowler_overs"></span>.<span id="bowler_ball_faced"></span>)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 shadow-lg team2 ">
                    <h6 class="mt-1 " id="bowling_team_name" style="color:white; text-shadow: 1px 1px 2px black;">
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.js" referrerpolicy="no-referrer"></script> --}}
    <script>
        var sseSource = new EventSource("/scoreBoard/" +
            {{ request()->id }});

        sseSource.onmessage = function(event) {
            let eventData = JSON.parse(event.data)
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
            console.log(eventData);

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
</body>

</html>
