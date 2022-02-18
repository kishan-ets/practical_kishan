<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Mail\SendMail;
use Auth;
use Hash;

class LoginController extends Controller
{
    //
    public function login(LoginRequest $request){
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'error' => config('constants.messages.user.invalid')
            ], config('constants.validation_codes.unprocessable_entity'));


        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if($user != null){

            $user->authorization = $tokenResult->accessToken;
            return new LoginResource($user);
        }else{
            return response("No User found.", config('constants.validation_codes.unprocessable_entity') );
        }
    }

    public static function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        return response(config('constants.messages.logout'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {        
        //get all updated data.
        $data = $request->all();
        // $masterUser = User::where('email', $request->user()->email)->first();
        $masterUser = User::where('email', $request->email)->first();

        if($masterUser){
            if (Hash::check($data['old_password'], $masterUser->password)) {
                $masterData['password'] = bcrypt($data['new_password']);
                //update user password in master user table
                if ($masterUser->update($masterData))
                    return response()->json(['success' => config('constants.messages.change_passowrd_success')], config('constants.validation_codes.ok'));
                else
                    return response()->json(['error' => config("constants.messages.something_wrong")],config('constants.validation_codes.unprocessable_entity'));
            }
            else
                return response()->json(['error' => config("constants.messages.invalid_old_password")],config('constants.validation_codes.unprocessable_entity'));
        }
        else
            return response()->json(['error' => config("constants.messages.invalid_email")],config('constants.validation_codes.unprocessable_entity'));

    }

    public function forgotPassword(ForgetPasswordRequest $request){
        $masterUser = User::where('email', $request->email)->first();

        if($masterUser){

            $random_pass = rand(0,999999);

            $masterUser->password = bcrypt($random_pass);

            $masterUser->save();

            $details = [
                'head' => 'Test Email',
                'title' => 'Forgot Password',
                'body' => 'Your New Password is '.$random_pass.'.',
                'subject' => 'Test Email',
                'view' => 'emails.forgotPasswordMail',
            ];
           
            \Mail::to($masterUser->email)->send(new SendMail($details));

            return response()->json(['success' => config('constants.messages.forgotpassword_success')],config('constants.validation_codes.ok'));
        }
        else
            return response()->json(['error' => config("constants.messages.invalid_email")],config('constants.validation_codes.unprocessable_entity'));
    }
}
