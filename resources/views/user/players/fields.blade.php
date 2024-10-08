 <div class="row">
     <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
         <label for="name">Add a Player </span></label>
         {{ html()->text('name')->class('form-control form-control-sm')->placeholder('Enter Player Name') }}
     </div>
     <input type="hidden" name="team_id" value="{{ $team_id }}">
     <div class="col-xl-12 col-sm-6 col-12 mb-2 mb-xl-0 mt-1">
         <input type="submit" name="submit" value="Save" class="btn btn-success btn-sm" />
         <a href="{{ request()->back }}" class="btn btn-secondary btn-sm"><i data-feather='arrow-left'></i>Back</a>
     </div>
 </div>
