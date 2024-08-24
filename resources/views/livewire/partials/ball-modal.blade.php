<div class="modal">
    <div class="modal-content">
        <span class="close" wire:click="closeModal">&times;</span>
        <h2>Add Ball Data</h2>
        <input type="text" wire:model="ball_number" placeholder="Ball Number">
        <input type="text" wire:model="runs" placeholder="Runs">
        <label><input type="checkbox" wire:model="is_wicket"> Wicket</label>
        <label><input type="checkbox" wire:model="is_four"> Four</label>
        <label><input type="checkbox" wire:model="is_six"> Six</
