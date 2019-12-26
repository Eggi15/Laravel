<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
    	if($request->has('cari')){
    		$data_siswa = \App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
    	}else{
    		$data_siswa = \App\Siswa::all();
    	}
    	return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    
    public function create(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpeg,png'
        ]);
        //insert ke table users
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('Axia1234');
        $user->remember_token = str_random(60);
        $user->save();

        //insert ke table siswa
        //([''])ini adalah array
        $request->request->add(['user_id' => $user->id ]);
        $siswa = \App\siswa::create($request->all());
        if($request->hasfile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

    	return redirect('\siswa')->with('sukses','Data Berhasil Diinput');
    }
    
    public function edit($id)
    {
         $siswa = \App\siswa::find($id);
    	return view('siswa\edit',['siswa' => $siswa]);
    }

    public function update(Request $request,$id)
    {

    	//dd($request->all());
        $siswa = \App\siswa::find($id);
    	$siswa->update($request->all());
        if($request->hasfile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
    	return redirect('\siswa')->with('sukses','Data Berhasil Di Update');
    }

    public function delete($id)
    {
    	$siswa = \App\siswa::find($id);
    	$siswa->delete();
    	return redirect('/siswa')->with('sukses','Data Berhasil Dihapus');
    }

    public function profile($id)
    {
        $siswa = \App\siswa::find($id);
        $matapelajaran =\App\mapel::all();

        //menyiapkan data untuk chart
        $categories = [];
        $data = [];

        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
            $categories[] = $mp->nama;
            $data[] = $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }

        // dd($data);
        //dd($matapelajaran);
        return view('siswa.profile',['siswa' => $siswa, 'matapelajaran' =>$matapelajaran, 'categories' => $categories, 'data' => $data]);
    }

    public function addnilai(Request $request,$idsiswa)
    {
        //dd($request->all());
        $siswa = \App\siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists()){
           return redirect('siswa/'.$idsiswa.'/profile')->with('error','Data Pelajaran Sudah Ada');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Data Nilai Berhasil Ditambahkan'); 
    }
}

