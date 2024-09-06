@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <h3>Teams of the Tournament</h3>
                    <ul style="color: red">
                        <li>All Teams of the specific Tournament</li>
                        {{-- <li>Admission Status are given below</li> --}}
                    </ul>
                    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                        <div class="mb-1 breadcrumb-right">
                            @php
                                $lastSegment = request()->segment(count(request()->segments()));
                            @endphp

                            <!-- Now you can use $lastSegment -->
                            <p>The last segment of the URL is: {{ $lastSegment }}</p>

                            <a class="dt-button create-new btn btn-primary"
                                href="{{ route('user.teams.addTeams', request()->id) }}"><i data-feather='plus'></i></a>
                        </div>
                    </div>
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
                                    @foreach ($matches as $match)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $team->Team1Match }}</td> --}}
                                            <td>
                                                {{ $match->tournament->name }}
                                            </td>
                                            <td>
                                                {{ $match->team1->name }}
                                            </td>
                                            <td>
                                                {{ $match->team2->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('user.manage.match', $match->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    Match</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @endif --}}
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
