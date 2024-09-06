<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Http\Requests\CreateRegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class UserAuthController extends Controller
{
    public $user;
    public function __construct(AuthContract $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function signUpPage()
    {
        try {

            return view('user.auth.signup');
        } catch (CustomException $th) {
            flash($th->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            Helper::logMessage('signup page', 'none', $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function loginUpPage()
    {
        try {

            return view('user.auth.login');
        } catch (CustomException $th) {
            flash($th->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            Helper::logMessage('signup page', 'none', $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRegisterRequest $request)
    {

        try {
            DB::beginTransaction();
            $this->user->store($request->prepareRequest());
            DB::commit();
            flash("Your Account Registered Successfully.")->success();
            return view('user.auth.signup');
        } catch (CustomException $th) {
            DB::rollBack();
            flash($th->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Helper::logMessage('register store', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function login(LoginRequest $request)
    {
        try {
            $user = $this->user->login($request->prepareRequest());
            if ($user->role_id === 2) {
                return redirect()->route('user.home');
            } else {
                return redirect()->route('admin.dashboard');
            }
        } catch (CustomException $th) {
            flash($th->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            Helper::logMessage('login ', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
