<?php

namespace App\Contracts;

interface AuthContract
{
    public function login($data);
    public function forgotPasswordOtp($data);
    public function forgotPasswordVerifyOtp($data);
    public function resetPassword($data);
    public function updatePassword($data);
    public function register($data);
    public function phone_verification($data);
    public function verifiedOtp($data);
    public function profile();
    public function update($data, $id);
    public function deleteAccount();
    public function loggedUserUpdatePassword($data);
    // public function forgot($data);
}