<div class="modal">
    <div class="modal-content">
        <span class="close" wire:click="closeModal">&times;</span>
        <h2>Add Bowler Performance</h2>
        <input type="text" wire:model="overs_bowled" placeholder="Overs Bowled">
        <input type="text" wire:model="runs" placeholder="Runs Conceded">
        <input type="text" wire:model="wickets" placeholder="Wickets">
        <input type="text" wire:model="maidens" placeholder="Maidens">
        <input type="text" wire:model="no_balls" placeholder="No Balls">
        <input type="text" wire:model="wides" placeholder="Wides">
        <button wire:click="storeBowlerPerformance">Save</button>
    </div>
</div>
