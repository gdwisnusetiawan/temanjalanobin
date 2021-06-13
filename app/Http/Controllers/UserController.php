<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $tab = $request->tab ?? null;
        return view('dashboard.user.index', compact('user', 'tab'));
    }

    public function update(Request $request, User $user)
    {
        // $validatedData = $request->validate([
        //     ''
        // ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->fullname = $request->fullname;
        $user->sex = $request->gender;
        $user->dateofbirth = Carbon::parse($request->dateofbirth)->format('Y-m-d');
        $user->nohp = $request->telephone;
        if($user->email != $request->email) {
            $user->email_verified_at = null;
        }
        $user->email = $request->email;
        $user->save();
        request()->session()->flash('notify', ['message' => 'User profile updated', 'type' => 'success']);
        return redirect()->route('dashboard.user.index', ['tab' => 'profile']);
    }

    public function changePassword(Request $request, User $user)
    {
        if (Hash::check($request->old_password, $user->password) || $user->password == null) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            if($validator->fails()) {
                return redirect('dashboard/user/'.$user->id.'?tab=password')->withErrors($validator);
            }

            $user->password = Hash::make($request->password);
            $user->save();
            request()->session()->flash('notify', ['message' => 'User password changed', 'type' => 'success']);
            return redirect()->route('dashboard.user.index', [$user, 'tab' => 'password']);
        }
        else {
            $error['old_password'] = 'Old password doesn\'t match';
            return redirect('dashboard/user/?tab=password')->withErrors($error);
        }
    }

    public function billing(Request $request, User $user)
    {
        $user->address = $request->address;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->postcode = $request->postcode;
        // $user->country = $request->country;
        if($request->region == 'national') {
            $user->country = null;
        }
        if($request->region == 'international') {
            $user->province = null;
            $user->city = null;
            $user->postcode = null;
        }
        $user->bankname = $request->bank_name;
        $user->banknumber = $request->bank_number;
        $user->bankowner = $request->bank_owner;
        $user->save();
        request()->session()->flash('notify', ['message' => 'User billing information changed', 'type' => 'success']);
        return redirect()->route('dashboard.user.index', ['tab' => 'billing']);
    }

    public function registration(Request $request, User $user)
    {
        // $status = 'approved';
        return view('dashboard.user.registration', compact('user'));
    }

    public function registerBusiness(Request $request, User $user)
    {
        // dd($request->all());
        $user->referalid = $request->referal_id;
        $user->nik = $request->nik;
        $user->save();
        request()->session()->flash('notify', ['message' => 'User billing information changed', 'type' => 'success']);
        return redirect()->route('dashboard.user.registration', [$user, 'tab' => 'billing']);
    }

    public function changeAvatar(Request $request, User $user)
    {
        // upload file if exists
        if($request->has('file'))
        {
            // delete old file
            // unlink(asset($user->avatarfile));
            // save new file
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file_location = $file->move('img/user/', $file_name);
            $user->avatarfile = $file_location;
            $user->save();
        }
        else
        {
            return response()->json(['error' => 'Please upload a file']);
        }
        return response()->json(['notify' => 'User avatar changed']);
    }

    public function upload(Request $request, User $user)
    {
        // upload file if exists
        if($request->has('ktp') && $request->file('ktp') != null)
        {
            // delete old file
            unlink(asset($user->ktpfile));
            // save new file
            $file = $request->file('ktp');
            $file_name = 'KTP-'.$user->id.'-'.time();
            $file_location = $file->move('img/user/', $file_name);
            $user->ktpfile = $file_location;
        }
        elseif($request->has('npwp') && $request->file('npwp') != null)
        {
            // delete old file
            unlink(asset($user->npwp));
            // save new file
            $file = $request->file('npwp');
            $file_name = 'NPWP-'.$user->id.'-'.time();
            $file_location = $file->move('img/user/', $file_name);
            $user->npwp = $file_location;
        }
        $user->save();
    }
}
