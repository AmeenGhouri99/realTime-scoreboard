<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Helpers\Constant;
use App\Traits\ImageUpload;
use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthService implements AuthContract
{
    use ImageUpload;

    public $model;
    public $phone_verification_model;
    public $section_model;
    public $answer_model;
    public $section__question_model;
    public $emergency_contact_information;

    public function __construct()
    {
        $this->model = new User();
    }

    public function profile()
    {
        $user = $this->model->find(Auth::id());

        return $user;
    }

    public function show($id) {}
    public function phone_verification($data)
    {
        $exist_phone_no_in_users = $this->model->where('phone', $data['phone'])->where('phone_country_code', $data['phone_country_code'])->first();
        if (!empty($exist_phone_no_in_users)) {
            throw new CustomException('Phone Number Already Exist!');
        }
        $exist_phone_verification_record = $this->phone_verification_model
            ->where('phone', $data['phone'])
            ->where('phone_country_code', $data['phone_country_code'])
            ->first();
        // if (!empty($exist_phone_verification_record)) {
        //     $model = $exist_phone_verification_record->update(['otp' => $data['otp']]);
        // } else {
        //     $model = new $this->phone_verification_model;
        //     $phone_verification = $this->phoneVerificationPrepareData($model, $data, true);
        // }
        // // $this->sendMessage('Your Med Legal Safe Keep verification code is ' . $data['otp'], $data['phone_country_code'] . $data['phone']);
        return true;
    }
    public function verifiedOtp($data)
    {
        $exist_phone_no_in_users = $this->model->where('phone', $data['phone'])->where('phone_country_code', $data['phone_country_code'])->count();
        if ($exist_phone_no_in_users > 0) {
            throw new CustomException(__('general.phone_number_already_exists'));
        }
        $exist_phone_verification_record = $this->phone_verification_model
            ->where('phone', $data['phone'])
            ->where('phone_country_code', $data['phone_country_code'])
            ->where('otp', $data['otp'])
            ->first();
        if (!$exist_phone_verification_record) {
            throw new CustomException("Phone Number Not Verified!");
        }
        $exist_phone_verification_record->update(['is_verified' => 1]);
        return $exist_phone_verification_record;
    }

    public function register($data)
    {
        $user = $this->model->where('phone', $data['phone'])->where('phone_country_code', $data['phone_country_code'])->count();
        if ($user > 0) {
            throw new CustomException('Phone No already exist!');
        }
        // check the phone number is verified
        // $this->phone_verification_model->where(['phone' => $data['phone'], 'phone_country_code' => $data['phone_country_code'], 'is_verified' => 1])->count() > 0 ? '' : throw new CustomException('Your Phone Number Not verified');
        $model = new $this->model;
        $user = $this->prepareData($model, $data, true);
        // // if user registration successful delete the existing record of the specific phone no form phone_verification table
        // $this->phone_verification_model->where(['phone' => $data['phone'], 'phone_country_code' => $data['phone_country_code'], 'is_verified' => 1])->delete();

        // Notification::saveNotification($user->id, $user->name . ' Your account has been sent to Admin, Admin will approve it soon.');
        return $user;
    }

    public function login($data)
    {
        // dd('okay');
        // if (!$this->model->isUniquePhone($data['phone_country_code'], $data['phone'])) {
        //     throw new CustomException(__('general.record_not_exist_against_phone_number'));
        // }
        $user = User::where('phone', $data['phone'])->where('phone_country_code', '+92')->first();
        if ($user->is_approved !== Constant::APPROVED) {
            throw new CustomException('Sorry your account is not approved yet!');
        }
        if (!Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])) {
            throw new CustomException('Invalid Credentials');
        }
        // if (isset($data['player_id']) && $data['player_id']) {
        //     $user->update(['player_id' => $data['player_id']]);
        // }
        return $user;
    }

    public function forgotPasswordOtp($data)
    {
        $user = $this->model->where('phone_country_code', $data['phone_country_code'])->where('phone', $data['phone'])->first();
        if (empty($user)) {
            throw new CustomException('Phone Number does not exist');
        }
        // $user->update(['otp' => $data['otp']]);
        // $this->sendMessage('Your Med Legal Safe Keep verification code is ' . $data['otp'], $data['phone_country_code'] . $data['phone']);
        return $user;
    }
    public function forgotPasswordVerifyOtp($data)
    {
        // $user_id = session('user_id');
        // dd($user_id);
        $user = $this->model->where('otp', $data['otp'])->find($data['user_id']);
        if (empty($user)) {
            throw new CustomException('Sorry Phone number Not Verified, Please re-enter OTP!');
        }
        return $user;
    }
    public function resetPassword($data)
    {
        $model = $this->model->find($data['user_id']);
        if (empty($model)) {
            throw new Exception("User Not Found!");
        }
        return $model->update(['password' => $data['password']]);
    }
    public function updatePassword($data)
    {
        if (!User::isUniquePhone($data['phone_country_code'], $data['phone'])) {
            throw new CustomException(__('general.incorrect_phone_and_country_code'));
        }
        $model = User::where('phone', $data['phone'])->where('phone_country_code', $data['phone_country_code'])->first();
        if (empty($model)) {
            throw new CustomException(__('general.user_not_found'));
        }
        $user = $this->prepareData($model, $data, false);

        return $user;
    }
    public function loggedUserUpdatePassword($data)
    {
        $user_id = Auth::id();
        $model = $this->model->find($user_id);
        if (empty($model)) {
            throw new Exception("User Not Found!");
        }

        if (isset($data['old_password']) && $data['old_password'] && $data['password']) {
            $check_old_password = Hash::check($data['old_password'], $model->password);
            if ($check_old_password === false) {
                throw new CustomException("Old Password Not Correct!");
            }
        }
        $hashed_password = Hash::make($data['password']);
        $model->update(['password' => $hashed_password]);
        return $model;
    }
    public function update($data, $id)
    {
        // dd($data);
        $model = $this->model->find($id);
        if (empty($model)) {
            throw new CustomException(__('general.user_not_found'));
        }
        $update_model_data = [];
        if (isset($data['old_password']) && $data['old_password'] && $data['password']) {
            $check_old_password = Hash::check($data['old_password'], $model->password);
            if ($check_old_password === false) {
                throw new CustomException("Old Password Not Correct!");
            }
            $update_model_data['password'] = Hash::make($data['password']);
        }
        if (isset($data['profile_image_url']) && $data['profile_image_url']) {
            $update_model_data['profile_image_url'] = $this->upload($data['profile_image_url']);
        }
        if (isset($data['full_name']) && $data['full_name']) {
            $update_model_data['name'] = $data['full_name'];
        }
        $model->update($update_model_data);
        return $model;
    }

    public function deleteAccount()
    {
        $user_id = Auth::id();
        $user = $this->model->find($user_id);
        if (empty($user)) {
            throw new CustomException(__('general.user_not_found'));
        }
        $user->delete();

        return true;
    }

    private function prepareData($model, $data, $new_record = false)
    {
        //Store name, phone number and password in users table having question id 1,2,3 respectively.
        if (isset($data['phone']) && $data['phone']) {
            $model->phone = $data['phone'];
        }
        if (isset($data['first_name']) && $data['first_name']) {
            $model->first_name = $data['first_name'];
        }
        if (isset($data['last_name']) && $data['last_name']) {
            $model->last_name = $data['last_name'];
        }
        if (isset($data['email']) && $data['email']) {
            $model->email = $data['email'];
        }
        if (isset($data['phone_country_code']) && $data['phone_country_code']) {
            $model->phone_country_code = '+92';
        }
        if (isset($data['profile_image']) && $data['profile_image']) {
            $image_path = $this->upload($data['profile_image']);
            $model->profile_image_url = $image_path;
        }
        if (isset($data['password']) && $data['password']) {
            $model->password = Hash::make($data['password']);
        }
        $model->role_id = Constant::USER_ROLE_ID;
        $model->save();

        return $model;
    }
    private function phoneVerificationPrepareData($model, $data, $new_record = false)
    {
        if (isset($data['phone_country_code']) && $data['phone_country_code']) {
            $model->phone_country_code = $data['phone_country_code'];
        }
        if (isset($data['phone']) && $data['phone']) {
            $model->phone = $data['phone'];
        }
        if (isset($data['otp']) && $data['otp']) {
            $model->otp = $data['otp'];
        }
        if (isset($data['is_verified']) && $data['is_verified']) {
            $model->is_verified = $data['is_verified'];
        }
        $model->save();
        return $model;
    }


    // private function sendMessage($message, $recipients)
    // {
    //     $account_sid = getenv("TWILIO_SID");
    //     $auth_token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_number = getenv("TWILIO_NUMBER");
    //     $client = new RestClient($account_sid, $auth_token);
    //     $client->messages->create($recipients,
    //             ['from' => $twilio_number, 'body' => $message] );
    // }
    // private function sendMessage($message, $recipients)
    // {
    //     $twilioConfig = config('services.twilio');

    //     $client = new Client($twilioConfig['sid'], $twilioConfig['token']);

    //     $client->messages->create($recipients, ['from' => $twilioConfig['from'], 'body' => $message]);
    // }
}
