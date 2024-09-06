<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\Helper;
use App\Http\Requests\CreateRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\WebLoginRequest;
use App\Http\Requests\WebOtpRequest;
use App\Http\Requests\WebResetPasswordRequest;
use App\Models\Country;
use Laracasts\Flash\Flash;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class AuthController extends Controller
{
    use ImageUpload;

    public $user;
    public function __construct(AuthContract $user)
    {
        $this->user = $user;
    }

    public function adminLoginPage()
    {
        if (Auth::check() && Auth::user()->role_id === Constant::ADMIN_ROLE_ID) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::check() && Auth::user()->role_id === Constant::USER_ROLE_ID) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.admin_login');
    }
    public function loginPage()
    {
        if (Auth::check() && Auth::user()->role_id === Constant::ADMIN_ROLE_ID) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::check() && Auth::user()->role_id === Constant::USER_ROLE_ID) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }
    public function registerPage()
    {
        return view('auth.signup');
    }
    public function forgotPage()
    {
        return view('auth.forgot');
    }
    public function forgotPasswordVerifyOtp()
    {
        return view('auth.verify_otp');
    }
    public function resetPassword()
    {
        return view('auth.reset_password');
    }
    public function register(CreateRegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->register($request->prepareRequest());
            DB::commit();
            $data = [
                'token' => $user->createToken(config('app.key'))->plainTextToken,
                'user' => $user,
            ];
            Flash::success(__('general.user_saved_successfully'));
            return back();
        } catch (CustomException $th) {
            DB::rollBack();
            return Flash::error($th->getMessage());
        } catch (\Exception $th) {
            DB::rollBack();
            Helper::logMessage('register', $request->input(), $th->getMessage());
            return Flash::error(__('general.something_went_wrong'));
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $user = $this->user->login($request->prepareRequest());
            // dd(Auth::user()->role_id);
            if ($user == true) {
                if (Auth::user()->role_id === Constant::ADMIN_ROLE_ID) {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('user.dashboard');
            }
            Flash::error(__('general.invalid_credential'));
            return back();
        } catch (CustomException $th) {
            Flash::error($th->getMessage());
            return back();
        } catch (\Exception $th) {
            Helper::logMessage('profile', $request->input(), $th->getMessage());
            Flash::error(__('general.something_went_wrong'));
            return back();
        }
    }
    // public function adminLogin(WebAdminLoginRequest $request)
    // {
    //     try {
    //         $user = $this->user->adminLogin($request->prepareRequest());
    //         if ($user == true) {
    //             if (Auth()->user()->role_id === Constant::ADMIN_ROLE_ID) {
    //                 return redirect()->route('admin.dashboard');
    //             }
    //             return redirect()->route('client.dashboard');
    //         }
    //         Flash::error(__('general.invalid_credential'));
    //         return back();
    //     } catch (CustomException $th) {
    //         return Flash::error($th->getMessage());
    //     } catch (\Exception $th) {
    //         Helper::logMessage('profile', $request->input(), $th->getMessage());
    //         return Flash::error(__('general.something_went_wrong'));
    //     }
    // }
    // public function forgot(WebForgotRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $user = $this->user->forgot($request->prepareRequest());
    //         DB::commit();
    //         session()->put('user_id', $user->id);
    //         return redirect()->route('forgot_password_verify_otp');
    //     } catch (CustomException $th) {
    //         DB::rollBack();
    //         Flash::error($th->getMessage());
    //         return back();
    //     } catch (\Exception $th) {
    //         DB::rollBack();
    //         Helper::logMessage('forgot', $request->input(), $th->getMessage());
    //         Flash::error('Something went Wrong!');
    //         return back();
    //     }
    // }
    // public function forgotPasswordVerifiedOtp(WebOtpRequest $request)
    // {
    //     try {
    //         $user = $this->user->verifiedOtp($request->prepareRequest());
    //         return redirect()->route('reset_password');
    //     } catch (CustomException $th) {
    //         Flash::error($th->getMessage());
    //         return back();
    //     } catch (\Exception $th) {
    //         Helper::logMessage('forgot', $request->input(), $th->getMessage());
    //         Flash::error('Something went Wrong!');
    //         return back();
    //     }
    // }
    // public function reset_Password(WebResetPasswordRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $user = $this->user->resetPassword($request->prepareRequest());
    //         DB::commit();
    //         session()->forget('user_id');
    //         Flash::success('Your Password Successfully Reset , Login Here!');
    //         return redirect()->route('login');
    //     } catch (CustomException $th) {
    //         DB::rollBack();
    //         Flash::error($th->getMessage());
    //         return back();
    //     } catch (\Exception $th) {
    //         DB::rollBack();
    //         Helper::logMessage('forgot', $request->input(), $th->getMessage());
    //         Flash::error('Something went Wrong!');
    //         return back();
    //     }
    // }
    // public function updatePassword(UpdatePasswordRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $user = $this->user->updatePassword($request->prepareRequest());
    //         DB::commit();
    //         //            $data = [
    //         //                'token' => $user->createToken('API TOKEN')->plainTextToken,
    //         //                'user'=> $user,
    //         //            ];
    //         Flash::success('Password Updated Successfully.');
    //         return back();
    //     } catch (CustomException $th) {
    //         DB::rollBack();
    //         return $this->failedResponse($th->getMessage());
    //     } catch (\Exception $th) {
    //         DB::rollBack();
    //         Helper::logMessage('update_password', $request->input(), $th->getMessage());
    //         return $this->failedResponse(__('general.something_went_wrong'));
    //     }
    // }
    // public function logout()
    // {
    //     try {
    //         Auth::logout();
    //         return redirect()->route('login');
    //     } catch (CustomException $th) {
    //         return $this->failedResponse($th->getMessage());
    //     } catch (\Exception $th) {
    //         Helper::logMessage('logout', 'none', $th->getMessage());
    //         return $this->failedResponse(__('general.something_went_wrong'));
    //     }
    // }

    public function profile()
    {
        try {
            $user = $this->user->profile();
            return view('admin.settings.index', compact('user'));
        } catch (CustomException $th) {
            return Flash::error($th->getMessage());
        } catch (\Exception $th) {
            Helper::logMessage('profile', 'none', $th->getMessage());
            return Flash::error(__('general.something_went_wrong'));
        }
    }
    // public function update(AdminUpdateProfileRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $user = $this->user->update($request->prepareRequest(), Auth::user()->id);
    //         DB::commit();
    //         Flash::success('Profile Updated Successfully.');
    //         return back();
    //     } catch (CustomException $th) {
    //         DB::rollBack();
    //         Flash::error($th->getMessage());
    //         return back();
    //     } catch (\Exception $th) {
    //         DB::rollBack();
    //         Helper::logMessage('profile ', $request->input(), $th->getMessage());
    //         Flash::error("Something Went Wrong");
    //         return back();
    //     }
    // }
}
