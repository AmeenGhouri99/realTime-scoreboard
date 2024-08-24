<div class="modal">
    <div class="modal-content">
        <span class="close" wire:click="closeModal">&times;</span>
        <h2>Add Batsman Score</h2>
        <input type="text" wire:model="runs" placeholder="Runs">
        <input type="text" wire:model="balls_faced" placeholder="Balls Faced">
        <input type="text" wire:model="fours" placeholder="Fours">
        <input type="text" wire:model="sixes" placeholder="Sixes">
        <button wire:click="storeBatsmanScore">Save</button>
    </div>
</div>
