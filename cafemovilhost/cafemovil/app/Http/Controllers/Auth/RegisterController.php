<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\School;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register',['schools' => School::all()]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['mimes:jpeg,jpg,png,gif|required|max:10000']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $student = new Student;
        $student->id_at_school = $data['id_at_school'];
        $student->name = $data['name'];
        $student->father_last_name = $data['father_last_name'];
        $student->mother_last_name = $data['mother_last_name'];
        $student->curp = $data['curp'];
        $student->email = $data['email'];
        $student->phone = $data['phone'];
        $student->id_school = $data['id_school'];

        $image = $data['image'];
        if ($image->isValid('image')) {
            $path = $image->store('profile-images');
            $student->image_url = $path;
        }

        $student->save();

        return User::create([
            'email' => $data['email'],
            'status' => false,
            'id_user_type' => 3,
            'password' => Hash::make($data['password']),
        ]);
    }
}
