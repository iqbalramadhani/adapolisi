<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use App\Models\MasterListPolres;
use App\Models\MasterListPolsek;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;


class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request('search')) {
            $user = User::where('nomor_registrasi_pokok', 'like', '%' . request('search') . '%')
                ->orWhere('first_name', 'like', '%' . request('search') . '%')
                ->orWhere('last_name', 'like', '%' . request('search') . '%')
                ->orWhere('full_name', 'like', '%' . request('search') . '%')
                ->paginate(10);
        } else {
            $user = User::paginate(10);
        }


        return view('pages.user_role.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $polres = MasterListPolres::all();
        $role = Role::all();

        return view('pages.user_role.form', compact('polres', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = [
            'role_id' => 'required',
            'full_name' => 'required',
            'email' => 'unique:users|required|email:rfc,dns',
            'no_telepon' => 'required|unique:users',
            'nomor_registrasi_pokok' => 'required|unique:users|digits:8',
            'password' => 'min:8|confirmed|required',
            'password_confirmation' => 'required|min:8',
            'jabatan' => 'required',
            'no_telepon' => 'required',
        ];

        $validasi_message = [
            'role_id.required' => 'Role harus di pilih',
            'full_name.required' => 'Nama Lengkap harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'no_telepon.required' => 'No kontak harus diisi',
            'no_telepon.unique' => 'No kontak sudah terdaftar',
            'nomor_registrasi_pokok.required' => 'No registrasi harus diisi',
            'nomor_registrasi_pokok.unique' => 'No registrasi sudah terdaftar',
            'nomor_registrasi_pokok.digits' => 'No registrasi harus terdiri dari 8 digit',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password konfirmasi tidak sama',
            'password_confirmation.required' => 'Password Konfirmasi harus disi',
            'password_confirmation.min' => 'Password minimal 8 karakter',
            'jabatan.required' => 'Jabatan harus disi',
        ];

        if (!empty($request->id_user)) {
            $validasi = [
                'role_id' => 'required',
                'full_name' => 'required',
                'no_telepon' => 'required',
                'jabatan' => 'required',
            ];

            $validasi_message = [
                'role_id.required' => 'Role harus di pilih',
                'full_name.required' => 'Nama Lengkap harus diisi',
                'no_telepon.required' => 'No kontak harus diisi',
                'nomor_registrasi_pokok.required' => 'No registrasi harus diisi',
                'nomor_registrasi_pokok.unique' => 'No registrasi sudah terdaftar',
                'jabatan.required' => 'Jabatan harus disi',
            ];

            if ($request->old_no_telepon != $request->no_telepon) {
                $validasi['no_telepon'] = 'required|unique:users';
                $validasi_message['no_telepon.unique'] = 'No kontak sudah terdaftar';
            }
        }

        $validator = Validator::make(
            $request->all(),
            $validasi,
            $validasi_message
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            if (!empty($request->id_user)) {
                $user = User::find($request->id_user);
            } else {
                $user = new User;
                $user->email = $request->email;
                $user->nomor_registrasi_pokok = $request->nomor_registrasi_pokok;
            }

            $user->role_id = $request->role_id;
            $user->status = $request->status;
            $user->full_name = $request->full_name;
            $user->polres_code = $request->polres_code;
            $user->polsek_code = $request->polsek_code;
            $user->jabatan = $request->jabatan;
            $user->no_telepon = $request->no_telepon;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            Alert::success('Success Title', 'Success Message');

            DB::commit();

            return redirect()->route('user_role.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = User::find($id);

        $polres = MasterListPolres::all();
        $role = Role::all();

        return view('pages.user_role.form', compact('detail', 'polres', 'role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $user = User::find($id);
            $user->delete();
            DB::commit();

            return redirect()->route('user_role.index');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function list_polsek(Request $request)
    {
        $id = $request->id;
        $polsek_code = $request->polsek;

        $polsek = MasterListPolsek::where('polres_code', $id)->get(['id', 'name']);

        return view('pages/user_role/list_polsek', compact('polsek', 'polsek_code'));
    }
}
