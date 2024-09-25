@extends('user.layouts.main')
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Academic Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                            <h5>All Tournaments</h5>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="dt-button create-new btn btn-primary content-end"
                                href="{{ route('user.tournaments.create') }}"><i data-feather='plus'></i></a>
                        </div>
                    </div>
                    <div class="card card-statistics">
                        <div class="card-body statistics-body">
                            @include('flash::message')
                            {{-- @include('user.home_page_modal') --}}
                            <h4>Your Tournaments</h4>
                            <table class="table" style="overflow:scroll">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Tournament Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tournaments->isEmpty())
                                        <tr class="text-center">
                                            <td colspan="8">You have Not Create any of Tournament</td>
                                        </tr>
                                    @else
                                        @foreach ($tournaments as $tournament)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $tournament->name }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-3"><a
                                                                href="{{ route('user.teams.teamsOfTournament', $tournament->id) }}"
                                                                class="btn btn-primary btn-sm">Check Teams</a>
                                                        </div>
                                                    </div>
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
