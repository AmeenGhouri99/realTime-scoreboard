<div>
    <h2>Match Management</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <button class="btn btn-primary mb-3" wire:click="create()">Add New Match</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Team 1</th>
                <th>Team 2</th>
                <th>Winner</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matches as $match)
                <tr>
                    <td>{{ $match->team1->name }}</td>
                    <td>{{ $match->team2->name }}</td>
                    <td>{{ $match->winner->name ?? 'N/A' }}</td>
                    <td>{{ $match->match_date }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" wire:click="edit({{ $match->id }})">Edit</button>
                        <button class="btn btn-danger btn-sm" wire:click="delete({{ $match->id }})">Delete</button>
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
                        <h5 class="modal-title">Match</h5>
                        <button type="button" class="btn-close" wire:click="closeModal()"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="team_1_id">Team 1</label>
                                <select class="form-control" id="team_1_id" wire:model="team_1_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                                @error('team_1_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="team_2_id">Team 2</label>
                                <select class="form-control" id="team_2_id" wire:model="team_2_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                                @error('team_2_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="winner_team_id">Winner Team</label>
                                <select class="form-control" id="winner_team_id" wire:model="winner_team_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                                @error('winner_team_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="match_date">Match Date</label>
                                <input type="date" class="form-control" id="match_date" wire:model="match_date">
                                @error('match_date')
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
