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
    <div class="container-fluid mt-5">
        <div class="content-align-center">
            <div class="row">
                <div class="col-1 shadow-lg team1">
                    <h6 class="mt-1">Team 1</h6>
                </div>
                <div class="col-10 rounded-pill shadow-lg main-scoreboard">
                    <div class="row">
                        <div class="col-2 player1">Player 1
                            <span>&nbsp 12(6)</span>
                        </div>
                        <div class="col-2 player2">Player 2
                            <span>&nbsp 12(6)</span>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="inner-scoreboard">
                                        <div class="row">
                                            <div class="col-4 text-center">
                                                <span id="playing_team_name">Team1</span>
                                            </div>
                                            <div class="col-4">
                                                <span id="playing_team_score">144</span>
                                                <span id="playing_team_out">/5</span>
                                            </div>
                                            <div class="col-4">
                                                <span id="running_over">Ovs. 13.5</span>
                                                <span id="total_overs">/20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="score-need">
                                        <p class="text-center">
                                            Team1 Need 55 Runs From 42 Balls
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 extras">
                            <div class="row">
                                <div class="col-12">
                                    Extras <span id="extras">20</span>
                                </div>
                                <div class="col-12">
                                    Target: <span id="target">200</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 bowler-info">
                            <div>Bowler Name
                                <span id="bowler_balls_and_overs">0.4/3</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 shadow-lg team2">
                    <h6 class="mt-1">Team 2</h6>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.js" referrerpolicy="no-referrer"></script>
    <script>
        var sseSource = new EventSource("/dashboard-sse");

        sseSource.onmessage = function(event) {
            let eventData = JSON.parse(event.data);
            $('#name').text(eventData.testData);
            console.log(eventData);
        };

        sseSource.onerror = function(event) {
            if (sseSource.readyState === EventSource.CLOSED) {
                console.log("Attempting to reconnect...");
                establishSSEConnection();
            }
        };

        function establishSSEConnection() {
            sseSource = new EventSource("/dashboard-sse");
        }
    </script>
</body>

</html>
