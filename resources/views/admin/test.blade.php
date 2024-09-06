@extends('admin.layouts.main')
@section('main-section')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            @php 
            $dashboard_contents = $dashboard;
            $blood_group = "";
            @endphp
            @foreach($dashboard_contents['sections'] as $dashboard_content)
            @if($dashboard_content['type'] === 'Personal Detail')
            <!-- user info-->
            <div class="row" style="margin-left:3px">
                <div class="col-md-5 col-12 mb-2 rounded shadow" style="height: 900px; width:350px; background-color:white">
                    @php
                        $personal_details = $dashboard_content['data'];
                    @endphp
                    @php 
                    $full_name = "";
                    $dob = "";
                    $address = "";
                    $phone_no = "";
                    @endphp
                    @foreach ($personal_details as $personal_detail)
                    @php
                        $data = json_decode($personal_detail['answer'], true);
                        if(isset($data['Full Name']) && $data['Full Name'] !== null){
                            $full_name = $data['Full Name'];
                        }
                        if(isset($data['Date Of Birth']) && $data['Date Of Birth'] !== null){
                            $dob = Carbon\Carbon::parse($data['Date Of Birth']);
                        }
                        if(isset($data['Phone Number']) && $data['Phone Number'] !== null){
                            $phone = $data['Phone Number'];
                        }
                        if(isset($data['Complete Address']) && $data['Complete Address'] !== null){
                            $address = $data['Complete Address'];
                        }

                    @endphp
                    @endforeach
                    <div class="text-center mt-5">
                        {{-- <img src="{{asset('app-assets/images/15.png')}}"> --}}
                        @php
                        try {
                                $profileImageUrl = auth()->check() ? auth()->user()->profile_image_url : null;
                                $imageSrc = $profileImageUrl ? asset($profileImageUrl) : asset('app-assets/med.jpeg');
                            } catch (\Exception $e) {
                                    $imageSrc = asset('app-assets/med.jpeg');
                            }
                        @endphp
                        <div class="user-nav ">
                            <span class="avatar"><img class="round" src="{{$imageSrc}}" alt="Avatar" height="80" width="80">
                            </span></div>
                        <h3 class="mt-1 mb-1" style="color: #5D596C; font-weight:bold">{{ $full_name }}</h3>
                    </div>
                    <div class="row mt-2 text-center">
                        <div class="col-6">
                            <span class="rounded" style="background: #EAE8FD; color:#8F85F3; padding:10px 14px 10px 14px; font-size:18px"> 
                                <i class="fas fa-user"></i></span> 
                                @if ($dob)
                                {{  now()->diffInYears($dob) }} Years Old
                                @else
                                   N/A
                                @endif 
                        </div>
                        <div class="col-6">
                            <span class="rounded" style="background: #EAE8FD; color:#8F85F3; padding:10px 14px 10px 14px;font-size:18px"> 
                                <i class="fa-solid fa-location-dot"></i></span> 
                                @if (isset($address) && $address !== null)
                                    {{ $address }}
                                @else
                                    N/A
                                @endif
                        </div>
                        <hr style="border-top: 2px solid #DBDADE; width: 90%; margin: 30px auto;">
                    </div>
                    <!-- end user info-->
                    <!-- sections part -->
                    <div class="row">
                        <p>Sections</p>
                        @foreach($dashboard_contents['sections'] as $section)

                        @php
                        $section_questions = $section['data'];
                       @endphp
                        <div class="row mt-2" style="cursor: pointer;">
                            <div class="col-2">
                            <span class="rounded" style="background: #EAE8FD; color:#8F85F3; padding:10px 14px 10px 14px; font-size:18px"> 
                                <i class="fas {{$section['icon']}}"></i></span>
                                {{-- <i class="fas {{fa-user}}"></i></span> --}}
                            </div>
                            <div class="col-8">
                                {!! Str::words($section['type'], 5, '...') !!}
                            </div>
                            <div class="col-2">
                                <input type="hidden" name="id" value="{{$section['id']}}">
                                <a href="#" class="view-section" data-section-id="{{ $section['id'] }}" style="background:#F2F2F3; color:#AEAFB3; padding:3px 13px">view</a>
                            </div> 
                        </div>

                        @endforeach
                    </div>
                    <!-- end sections part -->
                </div>
            <!-- section information -->   
                <div class="col-md-7 col-12 mb-2 rounded  ms-2 position-relative" style="height: 900px; width:660px;">
                    <!-- cards -->  
                    <div class="row mb-1">
                        @foreach ($contacts as $key => $emergency_contacts)
                        @php
                        $numItems = count($emergency_contacts);
                        $i = 0;
                        @endphp
                            @foreach($emergency_contacts['answer'] as $emergency_contact)
                        <div class="col-4 rounded shadow ms-1 mb-1" style="height: 125px;width:206px; background-color:#004F8C; color:white">
                            <p style="font-size: 16px; margin-top:15px">Emergency Contact# {{ $loop->iteration }}</p>
                            <div class="row">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <h5 style="font-weight:bold; color:white">Name: </h5>
                                            <h5 style="margin-left: 3px; color:white; white-space: nowrap">{{ $emergency_contact['Name'] ?? 'N/A' }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <h5 style="font-weight:bold; color:white">Phone: </h5>
                                            <h5 style="margin-left: 3px; color:white">{{ $emergency_contact['Phone'] ?? 'N/A' }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <h5 style="font-weight:bold; color:white">Relation: </h5>
                                            <h5 style="margin-left: 3px; color:white">{{ $emergency_contact['relation'] ?? 'N/A' }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @break
                        @endforeach
                    </div>
                    <!-- end cards --> 
                    <div id="ajaxResponse"></div>
                    <div id="showContent" class="m-0 ">
                        <div class="position-absolute" id="text-hide" style="left:15%;">
                        <img src="{{ asset('app-assets/medwhitetextlogo.png') }}" style="">
                        <h3>Please Click On View Button To See Section Data</h3>
                        {{-- <h3 class="position-absolute" id="text-hide" style="top: 50%; left:15%;">Please Click On View Button To See Section Data</h3> --}}
                        </div>
                        <div class="spinner-border position-absolute" role="status" style="top: 50%; left:50%; display:none" >
                            <span class="visually-hidden">Loading...</span>
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





@push('js_scripts')
    <script>
        $(document).ready(function() {
            // alert();
        // ajax request for sent question data into DB
        $(document).on('submit', '#questionForm', function(e){
            e.preventDefault();
            
            var formData = $(this).serialize();
            debugger

            // var formData = $this->serialize();

            // AJAX request
            $.ajax({
                url: "{{ route('client.section_question') }}",
                type: "POST",
                data: formData,
                success: function(response) {

                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error('An error occurred while processing your request.');
                }
            });

           
        });
            //  $('.radio-checkbox').click(function() {
            // //     // Uncheck all checkboxes with the same name except the one that was clicked
            //      $('input[name="' + $(this).attr('name') + '"]').not(this).prop('checked', false);
            //  });
            // let value = $('.radio-checkbox').val();
            // alert(value)

            $(document).on('click', '.radio-checkbox', function(e) {
                let radio_btn_value = $(this).val();
                let questionId = $(this).attr('data-question-id');
                let specifyInputField = $('#specify_input_field_' + questionId);
                // Remove all elements with class 'specify-input'
                //  specify_input.find('.specify-input').remove();
                if (radio_btn_value === 'Yes') {
                    $.ajax({
                        url: "{{ route('client.question_detail') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            question_id: questionId,
                        },
                        success: function(data) {
                            // Reset the visibility before appending new fields
                            $('.specify-input_' + questionId).hide();
                            specifyInputField.empty();
                            specifyInputField.show();

                            $.each(data, function(index, section_question) {
                                // console.log(section_question.option_values);

                                if (section_question.option_text !== undefined &&
                                    section_question.option_text !== null) {
                                    let label =
                                        `<label class="specify-input_${questionId}">${section_question.option_text}:</label>`;
                                    specifyInputField.append(label);
                                }
                                // Check if section_question.option_values is defined before using split
                                if (section_question.option_values !== undefined) {
                                    let splited_option = section_question.option_values
                                        .split('|');
                                    $.each(splited_option, function(index, option) {
                                        var input_type = option.split(':');
                                        let input_field =
                                            `
                                        <input type="${input_type[1]}" style="margin-top: 5px" class="form-control specify-input_${questionId} " placeholder="${input_type[0]}" name="answer_${section_question.id}[${input_type[0]}]">`;
                                        specifyInputField.append(input_field);
                                    });
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText); // Log the error response
                        }
                    });
                } else {
                    $('.specify-input_' + questionId).hide();
                    specifyInputField.find('.specify-input').remove();
                    specifyInputField.hide();
                }
            });

            let questionCounters = {}; // Store counters for each question

            $(document).on('click', '.add_more', function() {
                let question_id = $(this).attr('data-question-id');
                let section_id = $(this).attr('data-section-id');
                let existingFieldsCounter = $('#already_exist_fiels_' + question_id).data('counter') || 0;
                let upgrading_index_value = existingFieldsCounter - 1;
                // alert(existingFieldsCounter)
                // Initialize counter for the question if not already set
                if (!questionCounters[question_id]) {
                    questionCounters[question_id] = 1;
                }

                // Initialize counter based on existing fields or start from 1
                let counter = (existingFieldsCounter >= 1) ? upgrading_index_value + 1 : questionCounters[
                    question_id];

                let options = $(this).attr('data-question-option');
                let add_more_id = $('#add_more_' + question_id);
                let splited_options = options.split('|');

                add_more_id.on('click', '#delete_field', function() {
                    // Find the parent row and remove it
                    $(this).closest('.row').remove();
                });

                let input_field = [];

                $.each(splited_options, function(index, option) {
                    var input_type = option.split(':')[1];
                    var input_key = option.split(':')[0];
                    var fieldName = `answer_${question_id}[${counter}][${input_key}]`;
                    if (index == 3) {
                        input_field +=
                            `<div class="col-lg-2 col-sm-12">
                                <lable style="color:#003B69 !important">${input_key}:</lable>
                                <input type="${input_type}" class="form-control add_more" placeholder="Enter ${input_key}" name="${fieldName}">
                            </div>`;
                    } else {
                        input_field +=
                            `<div class="col-lg-3 col-sm-12">
                                <lable style="color:#003B69 !important">${input_key}:</lable>
                                <input type="${input_type}" class="form-control add_more" placeholder="Enter ${input_key}" name="${fieldName}">
                            </div>`;
                    }
                });

                const random_id_generator = Math.floor(Math.random() * 1000000);
                let uniqueDeleteButtonId = `delete_add_more_field_${random_id_generator}_${question_id}`;
                const svgContent = section_id !== '3' ?
                    `<line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>` :
                    `<line x1="5" y1="12" x2="19" y2="12"></line>`;

                add_more_id.append(`
                        <div class="row">
                            ${input_field}
                            <a class="col-lg-1 col-sm-12" id="${uniqueDeleteButtonId}" style="font-size: 30px; color: red;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px; height: 25px; margin-top:18px; margin-left:-10px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="${section_id !== '3' ? 'feather feather-x' : 'feather feather-minus'}">
                                    ${svgContent}
                                </svg>
                            </a>
                        </div>
                    `);

                // Event handler for dynamically created delete buttons
                add_more_id.on('click', `#${uniqueDeleteButtonId}`, function() {
                    // Find the parent row and remove it
                    $(this).closest('.row').remove();
                });

                if (existingFieldsCounter >= 1) {
                    counter++; // Increment the counter for the next set of fields
                } else {
                    questionCounters[question_id]++; // Increment the counter for the next set of fields
                }
            });

        });
    </script>
<script>
    $(document).ready(function () {
        $('.view-section').on('click', function (e) {
            e.preventDefault();

            // Hide the h3 text
            $('#text-hide').hide();
            // Show the spinner
            $('.spinner-border').show();

            var sectionId = $(this).data('section-id');

            // AJAX request
            $.ajax({
                url: "{{ url('client/sections') }}/"+sectionId, 
                type: 'GET',

                success: function (data) {
                    $('#showContent').html(data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
          
        });

    });


</script>

@endpush
