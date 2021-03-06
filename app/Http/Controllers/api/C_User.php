<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\HiValeeqaMail;
use App\Models\user\M_Product;
use App\Models\user\M_User;
use App\Models\user\M_Overview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class C_User extends Controller
{
    public function registerProcess(Request $request)
    {
        $model = new M_User();

        // Cek keunikan email dan username
        $check = $model->uniqueDataCheck($request->input());
        if ($check == 'email-exist') {
            session(['msg' => 'Email sudah pernah terdaftar!']);
            session(['status' => 'error']);
            return redirect('/register');
        } elseif ($check == 'username-exist') {
            session(['msg' => 'Username tidak tersedia, coba username lain!']);
            session(['status' => 'error']);
            return redirect('/register');
        }

        // Generate token
        $token = $this->generateToken();

        // Save token
        $model->saveEmailToken($request->input(), $token);

        // Kirim Email
        $this->sendEmail($request->input('email'), $request->input('fullname'), $token);

        // Register
        $register = $model->register($request->input());
        if ($register) {
            session(['msg' => 'Pendaftaran berhasil! Silakan cek email anda untuk melakukan verifikasi.']);
            session(['status' => 'success']);
        } else {
            session('msg', 'Pendaftaran gagal! Periksa kembali data anda.');
            session('status', 'error');
        }

        return redirect('/register');
    }

    public function generateToken()
    {
        return Str::random('6');
    }

    public function sendEmail($email, $name, $token)
    {
        Mail::to($email)->send(new HiValeeqaMail($name, $token));
    }

    public function verifyEmail(Request $request)
    {
        $input = $request->input();
        $model = new M_User();
        $verify = $model->verifyEmail($input['token']);
        if ($verify) {
            session(['msg' => 'Verifikasi email berhasil!']);
            session(['status' => 'success']);
            return redirect('/login');
        } else {
            session(['msg' => 'Kode token tidak sesuai!']);
            session(['status' => 'error']);
            return redirect('/verify-email');
        }
    }

    public function profile(Request $request)
    {
        $user_id = $request->input('user_id');
        $model = new M_User();
        $data['user'] = $model->getProfile($user_id);

        $modelCart = new M_Overview();
        $data['cart'] = $modelCart->getUserCartTotal();

        return response()->json($data);
    }

    public function updateProfile(Request $request)
    {
        $model = new M_User();
        $id = $request->input('user_id');
        $update = $model->updateProfile($request->input(), $id);
        if ($update) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }
    }

    public function changePassword(Request $request)
    {
        $model = new M_User();

        //Check password
        $checkPassword = $model->checkPassword($request->input('passwordNow'), $request->input('user_id'));
        if ($checkPassword > 0) {
            $model->changePassword($request->input('newPassword'), $request->input('user_id'));

            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }

    }

    public function address(Request $request)
    {
        $model = new M_User();
        $data['address'] = $model->getAddress($request->input('user_id'));

        return response()->json($data);
    }

    public function saveAddress(Request $request)
    {
        $model = new M_User();
        $save = $model->saveAddress($request->input(), $request->input('user_id'));

        if ($save) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }
    }

    public function wishlist(Request $request)
    {
        $model = new M_User();
        $user_id = $request->input('user_id');
        $model->wishlist($user_id, $request->segment(3));

        return response()->json(['status' => 1]);
    }

    public function removeWishlist(Request $request)
    {
        $model = new M_User();
        $user_id = $request->input('user_id');

        $model->removeWishlist($user_id, $request->segment(3));

        return response()->json(['status' => 0]);
    }

    public function changePasswordV()
    {
        $modelCart = new M_Overview();
        $data['cart'] = $modelCart->getUserCartTotal();

        return view('user.account.change-password', $data);
    }

    public function showWishlist(Request $request)
    {
        $modelCart = new M_Overview();
        $data['cart'] = $modelCart->getUserCartTotalAPI($request->input('user_id'));

        $model = new M_Product();
        $data['products'] = $model->showWishlistById($request->input('user_id'));

        return response()->json(['data' => $data]);
    }

    public function cart(Request $request)
    {
//        $modelCart = new M_Overview();
//        $data['cart'] = $modelCart->getUserCartTotal();

        $model = new M_Product();
        $data['products'] = $model->showCartById($request->input('user_id'));
//        $data['quantity'] = $model->getQuantityById($request->input('user_id'));
//        $modelUser = new M_User();
//        $data['user'] = $modelUser->getProfile(session()->get('id'));

        return response()->json($data);
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->segment(3);
        $model = new M_User();
        $add = $model->addToCart($request->input('user_id'), $product_id);

        if ($add) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }
    }

    public function plusItemCart(Request $request)
    {
        $product_id = $request->segment(3);
        $model = new M_User();
        $plus = $model->plusItemCart($request->input('user_id'), $product_id);

        if ($plus) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }

    }

    public function minusItemCart(Request $request)
    {
        $product_id = $request->segment(3);
        $model = new M_User();
        $minus = $model->minusItemCart($request->input('user_id'), $product_id);

        if ($minus) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }
    }

    public function removeCart(Request $request)
    {
        $product_id = $request->segment(3);
        $model = new M_User();
        $remove = $model->removeCart($request->input('user_id'), $product_id);

        if ($remove) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }
    }

    public function removeAllCart(Request $request)
    {
        $model = new M_Product();
        $remove = $model->removeAllCart($request->input('user_id'));

        if ($remove) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'error']);
        }
    }
}
