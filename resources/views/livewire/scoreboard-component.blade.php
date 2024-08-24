<div>
    <h4>Scoreboard</h4>
    <p>Batting Team: {{ $battingTeam->name }}</p>
    <p>Bowling Team: {{ $bowlingTeam->name }}</p>
    <!-- Display Batsmen -->
    <h5>Batsmen</h5>
    <ul>
        @foreach ($batsmen as $batsman)
            <li>{{ $batsman->name }} - Runs: {{ $batsman->runs_scored }}, Balls Faced: {{ $batsman->balls_faced }}</li>
        @endforeach
    </ul>
    <!-- Display Bowlers -->
    <h5>Bowlers</h5>
    <ul>
        @foreach ($bowlers as $bowler)
            <li>{{ $bowler->name }} - Runs Conceded: {{ $bowler->runs_conceded }}, Wickets: {{ $bowler->wickets }}</li>
        @endforeach
    </ul>
    <!-- Display Balls -->
    <h5>Balls</h5>
    <ul>
        @foreach ($balls as $ball)
            <li>Ball {{ $ball->ball_number }} - Runs: {{ $ball->runs }}, Wicket:
                {{ $ball->is_wicket ? 'Yes' : 'No' }}</li>
        @endforeach
    </ul>
    <!-- Display Score Summary -->
    <h5>Score Summary</h5>
    <p>Total Runs: {{ $match->team1Score->total_runs }}</p>
    <p>Total Wickets: {{ $match->team1Score->total_wickets }}</p>
    <p>Overs Faced: {{ $match->team1Score->overs_faced }}</p>
    <p>Pending Balls: {{ 6 - ($balls->count() % 6) }}</p>
</div>
