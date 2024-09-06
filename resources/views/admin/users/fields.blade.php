<div class="d-flex">
    <a href="#" class="me-25">
        <img src="{{ $user->profile_image_url ? asset($user->profile_image_url) : asset('app-assets/no-image-icon.png') }}"
            id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
    </a>
    <!-- upload and reset button -->
    <div class="d-flex align-items-end mt-75 ms-1">
        <div>
            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
            <input type="file" id="account-upload" name="profile_image" hidden accept="image/*" />
            <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
            <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
        </div>
    </div>
    <!--/ upload and reset button -->
</div>
<div class="validate-form mt-2 pt-50">
    <div class="row">
        <div class="mb-1 col-12 col-sm-6">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-12 col-sm-6 mb-1">
            {!! Form::label('phone', 'Phone:') !!}
            <div class="input-group input-group-merge">
                {!! Form::select(
                    'phone_country_code',
                    [
                        '' => '',
                        '+93' => '+93',
                        '+355' => '+355',
                        '+213' => '+213',
                        '+1' => '+1',
                        '+376' => '+376',
                        '+244' => '+244',
                        '+672' => '+672',
                        '+54' => '+54',
                        '+374' => '+374',
                        '+297' => '+297',
                        '+61' => '+61',
                        '+43' => '+43',
                        '+994' => '+994',
                        '+973' => '+973',
                        '+880' => '+880',
                        '+375' => '+375',
                        '+32' => '+32',
                        '+501' => '+501',
                        '+229' => '+229',
                        '+975' => '+975',
                        '+591' => '+591',
                        '+387' => '+387',
                        '+267' => '+267',
                        '+55' => '+55',
                        '+673' => '+673',
                        '+359' => '+359',
                        '+226' => '+226',
                        '+257' => '+257',
                        '+855' => '+855',
                        '+237' => '+237',
                        '+1' => '+1',
                        '+238' => '+238',
                        '+236' => '+236',
                        '+235' => '+235',
                        '+56' => '+56',
                        '+86' => '+86',
                        '+57' => '+57',
                        '+269' => '+269',
                        '+506' => '+506',
                        '+385' => '+385',
                        '+53' => '+53',
                        '+357' => '+357',
                        '+420' => '+420',
                        '+45' => '+45',
                        '+253' => '+253',
                        '+1' => '+1',
                        '+593' => '+593',
                        '+20' => '+20',
                        '+503' => '+503',
                        '+240' => '+240',
                        '+291' => '+291',
                        '+372' => '+372',
                        '+251' => '+251',
                        '+500' => '+500',
                        '+298' => '+298',
                        '+679' => '+679',
                        '+358' => '+358',
                        '+33' => '+33',
                        '+594' => '+594',
                        '+241' => '+241',
                        '+220' => '+220',
                        '+995' => '+995',
                        '+49' => '+49',
                        '+233' => '+233',
                        '+350' => '+350',
                        '+30' => '+30',
                        '+299' => '+299',
                        '+1' => '+1',
                        '+502' => '+502',
                        '+224' => '+224',
                        '+245' => '+245',
                        '+592' => '+592',
                        '+509' => '+509',
                        '+504' => '+504',
                        '+852' => '+852',
                        '+36' => '+36',
                        '+354' => '+354',
                        '+91' => '+91',
                        '+62' => '+62',
                        '+98' => '+98',
                        '+964' => '+964',
                        '+353' => '+353',
                        '+972' => '+972',
                        '+39' => '+39',
                        '+225' => '+225',
                        '+81' => '+81',
                        '+962' => '+962',
                        '+7' => '+7',
                        '+254' => '+254',
                        '+686' => '+686',
                        '+965' => '+965',
                        '+996' => '+996',
                        '+856' => '+856',
                        '+371' => '+371',
                        '+961' => '+961',
                        '+266' => '+266',
                        '+231' => '+231',
                        '+218' => '+218',
                        '+423' => '+423',
                        '+370' => '+370',
                        '+352' => '+352',
                        '+853' => '+853',
                        '+389' => '+389',
                        '+261' => '+261',
                        '+265' => '+265',
                        '+60' => '+60',
                        '+960' => '+960',
                        '+223' => '+223',
                        '+356' => '+356',
                        '+692' => '+692',
                        '+222' => '+222',
                        '+230' => '+230',
                        '+262' => '+262',
                        '+52' => '+52',
                        '+691' => '+691',
                        '+373' => '+373',
                        '+377' => '+377',
                        '+976' => '+976',
                        '+382' => '+382',
                        '+212' => '+212',
                        '+258' => '+258',
                        '+95' => '+95',
                        '+264' => '+264',
                        '+674' => '+674',
                        '+977' => '+977',
                        '+31' => '+31',
                        '+599' => '+599',
                        '+64' => '+64',
                        '+505' => '+505',
                        '+227' => '+227',
                        '+234' => '+234',
                        '+683' => '+683',
                        '+850' => '+850',
                        '+47' => '+47',
                        '+968' => '+968',
                        '+92' => '+92',
                        '+680' => '+680',
                        '+970' => '+970',
                        '+507' => '+507',
                        '+675' => '+675',
                        '+595' => '+595',
                        '+51' => '+51',
                        '+63' => '+63',
                        '+48' => '+48',
                        '+351' => '+351',
                        '+974' => '+974',
                        '+40' => '+40',
                        '+7' => '+7',
                        '+250' => '+250',
                        '+590' => '+590',
                        '+685' => '+685',
                        '+378' => '+378',
                        '+239' => '+239',
                        '+966' => '+966',
                        '+221' => '+221',
                        '+381' => '+381',
                        '+248' => '+248',
                        '+232' => '+232',
                        '+65' => '+65',
                        '+421' => '+421',
                        '+386' => '+386',
                        '+677' => '+677',
                        '+252' => '+252',
                        '+27' => '+27',
                        '+82' => '+82',
                        '+211' => '+211',
                        '+34' => '+34',
                        '+94' => '+94',
                        '+249' => '+249',
                        '+597' => '+597',
                        '+268' => '+268',
                        '+46' => '+46',
                        '+41' => '+41',
                        '+963' => '+963',
                        '+886' => '+886',
                        '+992' => '+992',
                        '+255' => '+255',
                        '+66' => '+66',
                        '+670' => '+670',
                        '+228' => '+228',
                        '+690' => '+690',
                        '+676' => '+676',
                        '+216' => '+216',
                        '+90' => '+90',
                        '+993' => '+993',
                        '+688' => '+688',
                        '+256' => '+256',
                        '+380' => '+380',
                        '+971' => '+971',
                        '+44' => '+44',
                        '+598' => '+598',
                        '+998' => '+998',
                        '+678' => '+678',
                        '+39' => '+39',
                        '+58' => '+58',
                        '+84' => '+84',
                        '+967' => '+967',
                        '+260' => '+260',
                        '+263' => '+263',
                    ],
                    null,
                    ['class' => 'input-group-text'],
                ) !!}

                {!! Form::number('phone', null, ['class' => 'input-group-text form-control']) !!}
            </div>
        </div>
        <div class="mb-1 col-12 col-sm-6">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select(
                'is_approved',
                [
                    '' => 'Select Status',
                    '1' => 'APPROVED',
                    '0' => 'PENDING',
                ],
                isset($user) && $user->is_approved == 1 ? 1 : 0,
                ['class' => 'form-control'],
            ) !!}


            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
            </div>
        </div>
    </div>
    <!--/ form -->
    @push('js_scripts')
        <script>
            $(document).ready(function() {
                var form = $('.validate-form'),
                    accountUploadImg = $('#account-upload-img'),
                    accountUploadBtn = $('#account-upload'),
                    accountUserImage = $('.uploadedAvatar'),
                    accountResetBtn = $('#account-reset');

                // Update user photo on click of button

                if (accountUserImage) {
                    var resetImage = accountUserImage.attr('src');
                    accountUploadBtn.on('change', function(e) {
                        var reader = new FileReader(),
                            files = e.target.files;
                        reader.onload = function() {
                            if (accountUploadImg) {
                                accountUploadImg.attr('src', reader.result);
                            }
                        };
                        reader.readAsDataURL(files[0]);
                    });

                    accountResetBtn.on('click', function() {
                        accountUserImage.attr('src', resetImage);
                    });
                }
            });
        </script>
    @endpush
