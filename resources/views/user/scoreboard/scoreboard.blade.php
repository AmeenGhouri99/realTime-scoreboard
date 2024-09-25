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
                    <h6 class="mt-1" id="batting_team"></h6>
                </div>
                <div class="col-10 rounded-pill shadow-lg main-scoreboard">
                    <div class="row">
                        <div class="col-2 player1">
                            <span id="first_player_name" style="font-weight: bold"></span>
                            <span id="first_player_runs"></span>
                            (<span id="first_player_ball_faced"></span>)

                        </div>
                        <div class="col-2 player2">
                            <span id="second_player_name" style="font-weight: bold"></span>
                            <span id="second_player_runs"></span>
                            (<span id="second_player_ball_faced"></span>)
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="inner-scoreboard">
                                        <div class="row">
                                            <div class="col-4 text-center">
                                                <span id="batting_team_name" style="font-weight: bold"></span>
                                            </div>
                                            <div class="col-4">
                                                <span id="batting_team_score"></span>
                                                /<span id="batting_team_out"></span>
                                            </div>
                                            <div class="col-4">
                                                <span style="font-size: 12px; font-weight:bold"> Ovs. &nbsp</span><span
                                                    id="running_over"></span>
                                                /<span id="total_overs"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="score-need">
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
                            <div id="bowler_name">
                                <span id="bowler_balls_and_overs">0.4/3</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 shadow-lg team2">
                    <h6 class="mt-1" id="bowling_team_name"></h6>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.js" referrerpolicy="no-referrer"></script> --}}
    <script>
        var sseSource = new EventSource("/scoreBoard/12");

        sseSource.onmessage = function(event) {
            let eventData = JSON.parse(event.data)
            $('#first_player_name').text(eventData.scoreboard.first_player_name);
            $('#second_player_name').text(eventData.scoreboard.second_player_name);
            // $('#batting_team_name').text(eventData.batting_team_name)
            $('#first_player_runs').text(eventData.scoreboard.first_player_runs)
            $('#first_player_ball_faced').text(eventData.scoreboard.first_player_ball_faced)
            $('#second_player_runs').text(eventData.scoreboard.second_player_runs)
            $('#second_player_ball_faced').text(eventData.scoreboard.second_player_ball_faced)
            $('#batting_team_score').text(eventData.scoreboard.total_scores)
            $('#batting_team_out').text(eventData.scoreboard.total_wickets)
            $('#running_over').text(eventData.scoreboard.overs_done)
            $('#total_overs').text(eventData.data.total_overs)
            $('#extras').text(eventData.scoreboard.extra)
            $('#bowler_name').text(eventData.scoreboard.bowler_name)
            $('#bowler_runs').text(eventData.scoreboard.bowler_runs)
            $('#bowler_overs').text(eventData.scoreboard.bowler_overs)
            $('#target').text(eventData.scoreboard.target)
            $('#bowling_team_name').text(eventData.bowling_team_name)
            $('#target_message').text(eventData.target_message)
            $('#batting_team_name,#batting_team').text(eventData.batting_team_name)


            console.log(eventData);

        };

        sseSource.onerror = function(event) {
            if (sseSource.readyState === EventSource.CLOSED) {
                console.log("Attempting to reconnect...");
                establishSSEConnection();
            }
        };

        function establishSSEConnection() {
            var sseSource = new EventSource("/scoreBoard/12");
        }
    </script>
</body>

</html>
