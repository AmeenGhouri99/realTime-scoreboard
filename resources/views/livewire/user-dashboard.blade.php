<div>
    <h2>User Dashboard</h2>
    <div class="row">
        <div class="col-md-3">
            <button wire:click="$emit('openModal', 'team-management')" class="btn btn-primary btn-block">Manage
                Teams</button>
        </div>
        <div class="col-md-3">
            <button wire:click="$emit('openModal', 'player-management')" class="btn btn-success btn-block">Manage
                Players</button>
        </div>
        <div class="col-md-3">
            <button wire:click="$emit('openModal', 'match-management')" class="btn btn-info btn-block">Manage
                Matches</button>
        </div>
        <div class="col-md-3">
            <button wire:click="$emit('openModal', 'tournament-management')" class="btn btn-warning btn-block">Manage
                Tournaments</button>
        </div>
    </div>
</div>
