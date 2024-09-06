@extends('admin.layouts.main')
@section('main-section')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                @php
                    $dashboard_contents = $dashboard;
                    $blood_group = '';
                @endphp
                @foreach ($dashboard_contents['sections'] as $dashboard_content)
                    @if ($dashboard_content['type'] === 'Personal Detail')
                        <!-- user info-->
                        <div class="row" style="margin-left:3px">
                            <div class="col-md-4 col-12 mb-2 rounded shadow pb-2" style="height:850px;background-color:white">
                                @php
                                    $personal_details = $dashboard_content['data'];
                                @endphp
                                @php
                                    $full_name = '';
                                    $dob = '';
                                    $address = '';
                                    $phone_no = '';
                                @endphp
                                @foreach ($personal_details as $personal_detail)
                                    @php
                                        $data = json_decode($personal_detail['answer'], true);
                                        if (isset($data['Full Name']) && $data['Full Name'] !== null) {
                                            $full_name = $data['Full Name'];
                                        }
                                        if (isset($data['Date Of Birth']) && $data['Date Of Birth'] !== null) {
                                            $dob = Carbon\Carbon::parse($data['Date Of Birth']);
                                        }
                                        if (isset($data['Phone Number']) && $data['Phone Number'] !== null) {
                                            $phone = $data['Phone Number'];
                                        }
                                        if (isset($data['Complete Address']) && $data['Complete Address'] !== null) {
                                            $address = $data['Complete Address'];
                                        }

                                    @endphp
                                @endforeach
                                <div class="text-center mt-1">
                                    {{-- <img src="{{asset('app-assets/images/15.png')}}"> --}}
                                    <img class="img-fluid rounded mt-3 mb-2"
                                        src="{{ isset($user->profile_image_url) && $user->profile_image_url != null ? $user->profile_image_url : asset('app-assets/user_default_image.png') }}"
                                        height="110" width="110" alt="User avatar" />
                                    <div class="user-info text-center">
                                        <h4>{{ $user->name }} <span>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"><i
                                                        data-feather='edit-3'></i></a></span></h4>
                                    </div>
                                    <div class="row mt-2 text-center">
                                        <div class="col-6">
                                            <span class="rounded"
                                                style="background: #EAE8FD; color:#004F8C; padding:5px 7px 5px 7px; font-size:12px">
                                                <i class="fas fa-phone"></i></span>
                                            {{ $user->phone_country_code . $user->phone }}
                                        </div>
                                        <div class="col-6">
                                            <span class="rounded"
                                                style="background: #EAE8FD; color:#004F8C; padding:5px 7px 5px 7px; font-size:12px">
                                                <i class="fas fa-clock"></i></span>
                                            @if ($dob)
                                                {{ now()->diffInYears($dob) }} Years Old
                                            @else
                                                N/A
                                            @endif
                                        </div>

                                        {{-- <div class="col-6">
                            <span class="rounded" style="background: #EAE8FD; color:#8F85F3; padding:10px 14px 10px 14px;font-size:18px"> 
                                <i class="fa-solid fa-location-dot"></i></span> 
                                @if (isset($address) && $address !== null)
                                    {{ $address }}
                                @else
                                    N/A
                                @endif
                        </div> --}}
                                        <hr style="border-top: 2px solid #DBDADE; width: 90%; margin: 30px auto;">
                                    </div>
                                    <!-- end user info-->
                                    <!-- sections part -->
                                </div>
                                <div class="row">
                                    <p>Sections</p>
                                    @foreach ($dashboard_contents['sections'] as $section)
                                        @php
                                            $section_questions = $section['data'];
                                        @endphp
                                        <div class="col-sm-12">
                                            <div class="row mt-2" style="cursor: pointer;">
                                                <div class="col-2">
                                                    <span class="rounded"
                                                        style="background: #EAE8FD; color:#004F8C; padding:10px 14px 10px 14px; font-size:18px">
                                                        <i class="fas {{ $section['icon'] }}"></i></span>
                                                    {{-- <i class="fas {{fa-user}}"></i></span> --}}
                                                </div>
                                                <div class="col-7">
                                                    {!! Str::words($section['type'], 5, '...') !!}
                                                </div>
                                                <div class="col-3">
                                                    <input type="hidden" name="id" value="{{ $section['id'] }}">
                                                    <a href="#" class="view-section"
                                                        data-section-id="{{ $section['id'] }}"
                                                        style="background:#F2F2F3; color:#AEAFB3; padding:3px 13px">view</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- end sections part -->
                            </div>
                            <!-- section information -->
                            <div class="col-md-8 col-12 mb-2 rounded">
                                <div class="row">
                                    @foreach ($contacts as $key => $emergency_contacts)
                                        @php
                                            $numItems = count($emergency_contacts);
                                            $i = 0;
                                            $count = 0;
                                        @endphp
                                        @foreach ($emergency_contacts['answer'] as $emergency_contact)
                                            @php
                                                $count = $loop->count;
                                            @endphp
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p style="font-size: 13px;">Emergency Contact#
                                                            {{ $loop->iteration }}</p>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="d-flex">
                                                                    <h5 style="font-weight:bold;">Name: </h5>
                                                                    <h5 style="margin-left: 3px;; white-space: nowrap">
                                                                        {{ $emergency_contact['Name'] ?? 'N/A' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="d-flex">
                                                                    <h5 style="font-weight:bold;">Phone: </h5>
                                                                    <h5 style="margin-left: 3px;">
                                                                        {{ $emergency_contact['Phone'] ?? 'N/A' }}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="d-flex">
                                                                    <h5 style="font-weight:bold;">Relation: </h5>
                                                                    <h5 style="margin-left: 3px;">
                                                                        {{ $emergency_contact['relation'] ?? 'N/A' }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if ($count <= 2)
                                            {{-- @dd($count) --}}
                                            @for ($i = $count; $i < 3; $i++)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p style="font-size: 13px;">Emergency Contact#
                                                                {{ $i + 1 }}</p>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="d-flex">
                                                                        <h5 style="font-weight:bold;">Name: </h5>
                                                                        <h5 style="margin-left: 3px;; white-space: nowrap">
                                                                            N/A</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="d-flex">
                                                                        <h5 style="font-weight:bold;">Phone: </h5>
                                                                        <h5 style="margin-left: 3px;">
                                                                            N/A</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="d-flex">
                                                                        <h5 style="font-weight:bold;">Relation: </h5>
                                                                        <h5 style="margin-left: 3px;">
                                                                            N/A</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    @break
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="ajaxResponse"></div>
                                    <div id="showContent" class="m-0">
                                        <div class="text-center">
                                            <div id="text-hide">
                                                <img src="{{ asset('app-assets/medlegalsafekeeplogo.png') }}">
                                                <h3>Please Click On View Button To See Section Data</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="spinner-border mt-5 " id="spinner-border" role="status"
                                            style="display:none">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Basic Tables end -->
                        </div>
                        <!-- end section information -->
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@include('client.action_js')
