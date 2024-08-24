@extends('components.layouts.app')

@section('content')
    <div>
        <h2>Manage Match Performance</h2>

        <!-- Over Management Form -->
        <h3>Overs</h3>
        <form wire:submit.prevent="createOrUpdateOver">
            <input type="hidden" wire:model="overId">
            <div class="form-group">
                <label for="overNumber">Over Number</label>
                <input type="number" wire:model="overNumber" class="form-control" id="overNumber"
                    placeholder="Enter over number">
            </div>
            <div class="form-group">
                <label for="bowlerId">Bowler</label>
                <select wire:model="bowlerId" class="form-control" id="bowlerId">
                    <option value="">Select Bowler</option>
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Over</button>
        </form>

        <hr>

        <!-- Ball Management Form -->
        <h3>Balls</h3>
        <form wire:submit.prevent="createOrUpdateBall">
            <input type="hidden" wire:model="ballId">
            <div class="form-group">
                <label for="ballNumber">Ball Number</label>
                <input type="number" wire:model="ballNumber" class="form-control" id="ballNumber"
                    placeholder="Enter ball number">
            </div>
            <div class="form-group">
                <label for="batsmanId">Batsman</label>
                <select wire:model="batsmanId" class="form-control" id="batsmanId">
                    <option value="">Select Batsman</option>
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="runs">Runs</label>
                <input type="number" wire:model="runs" class="form-control" id="runs" placeholder="Enter runs">
            </div>
            <div class="form-group">
                <label for="isWicket">Is Wicket?</label>
                <input type="checkbox" wire:model="isWicket" id="isWicket">
            </div>
            <div class="form-group">
                <label for="isFour">Is Four?</label>
                <input type="checkbox" wire:model="isFour" id="isFour">
            </div>
            <div class="form-group">
                <label for="isSix">Is Six?</label>
                <input type="checkbox" wire:model="isSix" id="isSix">
            </div>
            <div class="form-group">
                <label for="isExtra">Is Extra?</label>
                <input type="checkbox" wire:model="isExtra" id="isExtra">
            </div>
            <button type="submit" class="btn btn-primary">Save Ball</button>
        </form>

        <hr>

        <!-- Batsman Performance Management Form -->
        <h3>Batsman Performance</h3>
        <form wire:submit.prevent="createOrUpdateBatsmanPerformance">
            <input type="hidden" wire:model="batsmanPerformanceId">
            <div class="form-group">
                <label for="batsmanId">Batsman</label>
                <select wire:model="batsmanId" class="form-control" id="batsmanId">
                    <option value="">Select Batsman</option>
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="runsScored">Runs Scored</label>
                <input type="number" wire:model="runsScored" class="form-control" id="runsScored"
                    placeholder="Enter runs scored">
            </div>
            <div class="form-group">
                <label for="ballsFaced">Balls Faced</label>
                <input type="number" wire:model="ballsFaced" class="form-control" id="ballsFaced"
                    placeholder="Enter balls faced">
            </div>
            <div class="form-group">
                <label for="fours">Fours</label>
                <input type="number" wire:model="fours" class="form-control" id="fours"
                    placeholder="Enter number of fours">
            </div>
            <div class="form-group">
                <label for="sixes">Sixes</label>
                <input type="number" wire:model="sixes" class="form-control" id="sixes"
                    placeholder="Enter number of sixes">
            </div>
            <div class="form-group">
                <label for="dismissedBy">Dismissed By</label>
                <select wire:model="dismissedBy" class="form-control" id="dismissedBy">
                    <option value="">Select Bowler</option>
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Performance</button>
        </form>

        <hr>

        <!-- Bowler Performance Management Form -->
        <h3>Bowler Performance</h3>
        <form wire:submit.prevent="createOrUpdateBowlerPerformance">
            <input type="hidden" wire:model="bowlerPerformanceId">
            <div class="form-group">
                <label for="bowlerId">Bowler</label>
                <select wire:model="bowlerId" class="form-control" id="bowlerId">
                    <option value="">Select Bowler</option>
                    @foreach ($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="oversBowled">Overs Bowled</label>
                <input type="number" wire:model="oversBowled" class="form-control" id="oversBowled"
                    placeholder="Enter overs bowled">
            </div>
            <div class="form-group">
                <label for="runsConceded">Runs Conceded</label>
                <input type="number" wire:model="runsConceded" class="form-control" id="runsConceded"
                    placeholder="Enter runs conceded">
            </div>
            <div class="form-group">
                <label for="wickets">Wickets</label>
                <input type="number" wire:model="wickets" class="form-control" id="wickets"
                    placeholder="Enter wickets taken">
            </div>
            <div class="form-group">
                <label for="maidens">Maidens</label>
                <input type="number" wire:model="maidens" class="form-control" id="maidens"
                    placeholder="Enter maidens">
            </div>
            <div class="form-group">
                <label for="noBalls">No Balls</label>
                <input type="number" wire:model="noBalls" class="form-control" id="noBalls"
                    placeholder="Enter no balls">
            </div>
            <div class="form-group">
                <label for="wides">Wides</label>
                <input type="number" wire:model="wides" class="form-control" id="wides" placeholder="Enter wides">
            </div>
            <button type="submit" class="btn btn-primary">Save Performance</button>
        </form>

        <hr>

        <!-- Display Existing Overs, Balls, Batsman, and Bowler Performance -->
        <h3>Existing Performance Data</h3>
        <div class="row">
            <div class="col-md-6">
                <h4>Overs</h4>
                <ul>
                    @foreach ($overs as $over)
                        <li>
                            Over {{ $over->over_number }} by {{ $over->bowler->name }}
                            <button wire:click="editOver({{ $over->id }})" class="btn btn-sm btn-info">Edit</button>
                            <button wire:click="deleteOver({{ $over->id }})"
                                class="btn btn-sm btn-danger">Delete</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h4>Balls</h4>
                <ul>
                    @foreach ($overs as $over)
                        <li>
                            Over {{ $over->over_number }} Balls:
                            <ul>
                                @foreach ($over->balls as $ball)
                                    <li>
                                        Ball {{ $ball->ball_number }}: {{ $ball->runs }} runs by
                                        {{ $ball->batsman->name }}
                                        <button wire:click="editBall({{ $ball->id }})"
                                            class="btn btn-sm btn-info">Edit</button>
                                        <button wire:click="deleteBall({{ $ball->id }})"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
