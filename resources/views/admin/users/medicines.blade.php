@extends('admin.users.show')
@section('section')
    <!-- Activity Timeline -->
    {{-- <div class="card">
        <h4 class="card-header"></h4>
        <div class="card-body pt-1"> --}}
    @php
        $answers = json_decode($user->answer, true);
    @endphp
    <div class="row">
        <h1 class="main_label">Medicines</h1>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card text-center rounded-3" style="background-color: #E1C1F0;">
                <div class="card-body">
                    <div class="row text-start">
                        <p>
                            <span class="medicine">Omeprazole</span>
                            <span class="medicine_qty">20 MG, Daily</span>
                        </p>
                        <p>
                            <span class="medicine">Loprin</span>
                            <span class="medicine_qty">10 MG, Twice a day</span>
                        </p>
                        <p>
                            <span class="medicine">Panadol</span>
                            <span class="medicine_qty">Daily</span>
                        </p>
                        <a href="#" class="text-end">Update Medicine ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /Activity Timeline -->
@endsection
