<?php

namespace App\Http\Controllers;

use App\Models\Citie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Province;
use App\Models\District;
use App\Models\User;

class CostumerRegistriController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm(){
        if (Auth::guard('costumer')->check()) {
            return redirect('/costumer/home');
        }
        else {
            $provinces = Province::orderBy('created_at', 'DESC')->get();

            return view('costumerAuth.register', compact('provinces'));
        }
    }

    public function getCity()
    {
        $cities = Citie::where('province_id', request()->province_id)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }

    public function getDistrict()
    {
        $districts = District::where('city_id', request()->city_id)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }

    protected function createCostumer(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:11'],
            'address' => ['required', 'string'],
            'province_id' => ['required'],
            'citie_id' => ['required'],
            'district_id' => ['required'],
        ]);

        $data =  new Customer();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->province_id = $request->province_id;
        $data->citie_id = $request->citie_id;
        $data->district_id = $request->district_id;
        $data->save();
        session()->flash('success', 'Anda berhasil register.');
        return redirect('/costumer/login');
    }

    protected function createadmin(Request $request)
    {
        $data =  new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->password = bcrypt($request->password);
        $data->save();
        session()->flash('success', 'Anda berhasil register.');
        return redirect('/login');
    }

    protected function updateFormCostumer(Request $request){

    }

    protected function updateCostumer(Request $request){

    }

    // public function createCostumer(Array $input){
    //     Validator::make($input, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
    //         'password' => $this->passwordRules(),
    //     ])->validate();

    //     return Customer::create([
    //         'name' => $input['name'],
    //         'email' => $input['email'],
    //         'password' => Hash::make($input['password']),
    //     ]);
    // }
}
