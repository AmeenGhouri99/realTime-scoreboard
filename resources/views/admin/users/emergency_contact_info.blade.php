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
        <h1 class="main_label">Personal Details</h1>
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card text-center rounded-3" style="background-color: #FFE7B9;">
                <div class="card-body">
                    <div class="row text-start">
                        <div class="col-sm-6">
                            @foreach (collect($answers)->where('question_id', \App\Helpers\Constant::FULL_NAME_QUESTION_ID) as $key => $answer)
                                @php
                                    $user_name = json_decode($answer['answer'], true);
                                @endphp
                                <h6 class="card_label">Name</h6>
                                <h3 class="card_title">{{ isset($user_name['Full Name']) ? $user_name['Full Name'] : 'N/A' }}</h3>
                            @break
                        @endforeach
                    </div>
                    <div class="col-sm-6">
                        @foreach (collect($answers)->where('question_id', \App\Helpers\Constant::DOB_QUESTION_ID) as $key => $answer)
                            @php
                                $dob = json_decode($answer['answer'], true);
                            @endphp
                            <h6 class="card_label">age</h6>
                            <h3 class="card_title">
                                @if (isset($dob['Date Of Birth']) && $dob['Date Of Birth'])
                                    {{ now()->diffInYears(Carbon\Carbon::parse($dob['Date Of Birth'])) }} Years Old
                                @else
                                    N/A
                                @endif
                            </h3>
                        @break
                    @endforeach
                </div>
                <div class="col-sm-6">
                    <h6 class="card_label">Height / Weight</h6>
                    <h3 class="card_title">175 cm / 82 Kg</h3>
                </div>
                <div class="col-sm-6">
                    <h6 class="card_label">Blood Type</h6>
                    @foreach (collect($answers)->where('question_id', \App\Helpers\Constant::BLOOD_QUESTION_ID) as $key => $answer)
                        @php
                            $user_blood_group = json_decode($answer['answer'], true);
                                $blood_group = $user_blood_group[0][0];
                        @endphp
                    @endforeach
                    <h3 class="card_title">
                        @if(isset($blood_group) && $blood_group !== null)
                        {{ $blood_group }}
                        @else
                        N/A
                        @endif
                    </h3>
                </div>
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <a href="#">See Details ></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-6 col-md-6 col-sm-12">
    <div class="card text-center rounded-3" style="background-color: #ABD4F4;">
        <div class="card-body">
            <div class="row text-start">
                <h1 class="main_label">Emergency Details</h1>
                @php $emergency_contact_informations =collect($answers)->where('question_id', \App\Helpers\Constant::EMERGENCY_CONTACT_DETAIL_QUESTION_ID); 
                @endphp
                @if(!$emergency_contact_informations->isEmpty())
                @foreach ($emergency_contact_informations as $key => $answer)
                @php
                    $emergency_contacts = json_decode($answer['answer']);
                @endphp
                @if (is_array($emergency_contacts) || is_object($emergency_contacts))
                    @foreach ($emergency_contacts as $emergency_contact)
                        <div class="col-sm-6">
                            <h6 class="card_label">Name</h6>
                            <h3 class="card_title">{{ $emergency_contact->Name !== null ? $emergency_contact->Name : 'N/A' }}</h3>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="card_label">Phone Number</h6>
                            <h3 class="card_title">{{ is_object($emergency_contact) && $emergency_contact->Phone ? $emergency_contact->Phone : 'N/A' }}</h3>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="card_label">Relation</h6>
                            <h3 class="card_title">{{ is_object($emergency_contact) && $emergency_contact->relation ? $emergency_contact->relation  : 'N/A'}}</h3>
                        </div>
                        @break
                    @endforeach
                @endif
            @endforeach
            @else
            <div class="col-sm-6">
                <h6 class="card_label">Name</h6>
                <h3 class="card_title">N/A</h3>
            </div>
            <div class="col-sm-6">
                <h6 class="card_label">Phone Number</h6>
                <h3 class="card_title">N/A</h3>
            </div>
            <div class="col-sm-6">
                <h6 class="card_label">Relation</h6>
                <h3 class="card_title">N/A</h3>
            </div>
            @endif
            <div class="col-sm-6">
                <a href="#">See More ></a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /Activity Timeline -->
@endsection
