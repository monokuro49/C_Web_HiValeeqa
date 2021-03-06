<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Overview extends Model
{
    public function login($data)
    {
        $query = DB::table('user')->select('*')->where(function ($query) use ($data) { $query->where('username', '=', $data['userEmail'])->orWhere('email', '=', $data['userEmail']);})->where('password', '=', md5($data['password']));
        $count = $query->count();
        $result = $query->first();
        if ($count > 0) {
            // Cek apakah email sudah terverifikasi atau belum
            $check = DB::table('email_verification')->select("status")->where('email', '=', $result->email)->first();
            if ($check->status < 1) {
                $data['email'] = $result->email;
                $data['status'] = 'error-verification';
                return $data;
            } else {
                // Cek apakah user sudah mengisi data diri lengkap
                $biodata = DB::table('user')->select("*")->where(function ($query) use ($data) { $query->where('username', '=', $data['userEmail'])->orWhere('email', '=', $data['userEmail']);})->first();
                if($biodata->address == ''){
                    $data['user'] = $biodata;
                    $data['status'] = 'error-complete';
                }else{
                    // Login normal
                    session(['loggedIn' => true]);
                    session(['id' => $biodata->user_id]);
                    session(['username' => $biodata->username]);
                    session(['name' => $biodata->name]);
                    session(['email' => $biodata->email]);
                    session(['role' => $biodata->role]);
                    $data['user'] = $biodata;
                    $data['status'] = 'success';
                }
                return $data;
            }
        }else{
            $data['status'] = 'error';
        }

        return $data;
    }

    public function getRandomProducts()
    {
        return DB::table('product')->join('image', 'product.product_id', '=', 'image.product_id')->select('product.*', 'image.image')->inRandomOrder()->limit(4)->get();

    }

    public function forgotPassword($input)
    {
        $query = DB::table('user')->select(['user_id', 'name'])->where('email', '=', $input);
        $data['count'] = $query->count();
        $data['data'] = $query->first();
        return $data;
    }

    public function saveResetPasswordToken($email, $token)
    {
        // Check email if exist on reset_password table
        $query = DB::table('reset_password')->select('*')->where('email', $email)->count();
        if ($query > 0) {
            return DB::table('reset_password')->where('email', $email)->update(['token' => $token]);
        } else {
            return DB::table('reset_password')->insert(['email' => $email, 'token' => $token]);
        }

    }

    public function checkToken($token)
    {
        return DB::table('reset_password')->select('*')->where('token', '=', $token)->count();
    }

    public function resetPasswordProcess($input)
    {
        $email = DB::table('reset_password')->select('email')->where('token', $input['t'])->first();
        $email = $email->email;
        return DB::table('user')->where('email', '=', $email)->update(['password' => md5($input['newPassword'])]);
    }

    public function removeResetPasswordToken($token)
    {
        DB::table('reset_password')->where('token', '=', $token)->delete();
    }

    public function updateEmailToken($email, $token)
    {
        DB::table('email_verification')->where('email', $email)->update(['token' => $token]);
    }

    public function getName($email)
    {
        $query = DB::table('user')->select('name')->where('email', $email)->first();
        return $query->name;
    }

    public function getUserCartTotal()
    {
        return DB::table('cart')->select('*')->where('user_id', session()->get('id'))->count();
    }
    public function getUserCartTotalAPI($id)
    {
        return DB::table('cart')->select('*')->where('user_id', $id)->count();
    }
}
