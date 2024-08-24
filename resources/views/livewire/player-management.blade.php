<div>
    <h2>Player Management</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <button class="btn btn-primary mb-3" wire:click="create()">Add New Player</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
                <tr>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->position }}</td>
                    <td>{{ $player->team->name }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" wire:click="edit({{ $player->id }})">Edit</button>
                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $player->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($isModalOpen)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Player</h5>
                        <button type="button" class="btn-close" wire:click="closeModal()"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Player Name</label>
                                <input type="text" class="form-control" id="name" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="position" wire:model="position" name="position">
                                    <option value="" selected disabled>Select Position</option>
                                    <option value="batsman">Batsman</option>
                                    <option value="bowler">Bowler</option>
                                    <option value="all-rounder">All-Rounder</option>
                                    <option value="wicketkeeper">Wicketkeeper</option>
                                </select>
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="team_id">Team</label>
                                <select class="form-control" id="team_id" wire:model="team_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal()">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="store()">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
