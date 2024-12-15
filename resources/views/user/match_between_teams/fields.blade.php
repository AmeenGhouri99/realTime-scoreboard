 <div class="row">
     <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
         <label for="name">select Two Teams Here
             (-)) </span></label>
         {{ html()->select('team_id', $teams)->class('form-control form-control-sm')->placeholder('Enter Team 1 Name') }}
     </div>
     <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
         <label for="name">Team 2
             (-)) </span></label>
         {{ html()->text('team2_name')->class('form-control form-control-sm')->placeholder('Enter Team 2 Name') }}
     </div>
     <input type="hidden" value="{{ $tournament->id }}" name="tournament_id">
     <div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
         <a href="{{ url('home') }}" class="btn btn-primary"><i data-feather='arrow-left'></i>Back</a>
         <input type="submit" name="submit" value="Save & Go To Next" class="btn btn-success btn-sm" />

     </div>
 </div>
