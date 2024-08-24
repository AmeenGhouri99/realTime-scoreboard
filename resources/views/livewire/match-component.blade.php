<div>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#matchModal">Add
            Match</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Team 1</th>
                    <th>Team 2</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Toss Winner</th>
                    <th>Decision</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matches as $match)
                    <tr>
                        <td>{{ $match->id }}</td>
                        <td>{{ $match->team1->name }}</td>
                        <td>{{ $match->team2->name }}</td>
                        <td>{{ $match->date }}</td>
                        <td>{{ $match->location }}</td>
                        <td>{{ $match->tossWinner->name ?? 'n/a' }}</td>
                        <td>{{ $match->decision }}</td>
                        <td>
                            <button wire:click="edit({{ $match->id }})" class="btn btn-warning btn-sm">Edit</button>
                            <button wire:click="delete({{ $match->id }})" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="matchModal" tabindex="-1" aria-labelledby="matchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="matchModalLabel">Manage Match</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                            <div class="mb-3">
                                <label for="team1_id" class="form-label">Team 1</label>
                                <select class="form-select" id="team1_id" wire:model="team1_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="team2_id" class="form-label">Team 2</label>
                                <select class="form-select" id="team2_id" wire:model="team2_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" wire:model="date">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" wire:model="location">
                            </div>
                            <div class="mb-3">
                                <label for="toss_winner_team_id" class="form-label">Toss Winner</label>
                                <select class="form-select" id="toss_winner_team_id" wire:model="toss_winner_team_id">
                                    <option value="">Select Team</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="decision" class="form-label">Decision</label>
                                <select class="form-select" id="decision" wire:model="decision">
                                    <option value="">Select Decision</option>
                                    <option value="bat">Bat</option>
                                    <option value="bowl">Bowl</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
