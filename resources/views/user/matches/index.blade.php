@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <h3>Matches Details</h3>
                    <ul style="color: red">
                        <li>Here the all matches of the specific Tournament will show</li>
                        {{-- <li>Admission Status are given below</li> --}}
                    </ul>
                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            @include('flash::message')
                            {{-- @include('user.home_page_modal') --}}
                            <h4>Matches</h4>
                            <table class="table" style="overflow:scroll">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Tournament Name</th>
                                        <th>Team 1</th>
                                        <th>Team 2</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($team->tournament->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="8">No Match is being Created</td>
                                        </tr>
                                    @else
                                        @foreach ($teams as $team)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $team->Team1Match->team1->name }}</td>
                                                <td>{{ $team->Team2Match->team2->name }}</td>
                                                <td>
                                                    <button>Edit</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Academic Card -->
    </div>
    </section>

    </div>
    <!-- END: Content-->
@endsection
@push('js_scripts')
    <script>
        $(document).ready(function() {
            $('#shareProject').modal('show');
        });
    </script>
@endpush
