<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\getToken;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\getVerifyCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function getVerifyCode(getVerifyCode $getVerifyCode)
    {
        $success = true;
        DB::beginTransaction();
        try {
            $verify_code = random_int(1000, 9999);

            $user_exists = User::query()->where('mobile', '=', $getVerifyCode->mobile)->first();

            if (isset($user_exists)) {
                $user_exists->verify_code = $verify_code;
                $user_exists->save();

                /* ارسال پیامک */
            } else {
                $user = User::query()->create([
                    'mobile' => $getVerifyCode->mobile,
                    'verify_code' => $verify_code
                ]);

                if (!$user) {
                    $success = false;
                }
            }

            DB::commit();
        } catch (\Exception $exception) {
            $success = false;
            DB::rollBack();
        }

        if ($success) {
            return Message::Message(['verify_code' => $verify_code], true);
        } else {
            return Message::Message([], false);
        }
    }

    public function getToken(getToken $getToken)
    {
        $success = true;
        DB::beginTransaction();
        try {
            $user = User::query()->where('mobile', '=', $getToken->mobile)->first();
            if (!$user) {
                $success = false;
            } else {
                $user->tokens()->delete();
                if ($user->verify_code == $getToken->verify_code) {
                    $token = $user->createToken($getToken->mobile);
                    if ($token) {
                        $user->verify_code = '';
                        $user->save();
                    }
                } else {
                    $success = false;
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            $success = false;
            DB::rollBack();
        }

        if ($success) {
            return Message::Message(['token' => "Bearer $token->plainTextToken"], true);
        } else {
            return Message::Message([], false);
        }
    }
}
