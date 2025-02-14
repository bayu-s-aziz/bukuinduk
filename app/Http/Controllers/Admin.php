<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dad;
use App\Models\Mutation;
use App\Models\Mom;
use App\Models\Group;
use App\Models\Guardian;
use App\Models\Year;
use App\Models\Biodata;
use App\Models\Student;

class Admin extends Controller
{
    public function index()
    {
        $mutasi = Mutation::latest()->get();
        $murid = Student::all();
        $tahun = Year::all();
        $siswa_yatim_piatu = $murid->filter(function ($val) {
            if (optional($val->ayah)->status === 'Telah Meninggal' || optional($val->ibu)->status === 'Telah Meninggal') {
                return $val;
            }
        });

        $siswa = Biodata::latest()->get();
        $kelas = Group::latest()->get();
        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'jumlah_siswa' => $siswa->count(),
            'siswa' => $siswa,
            'jumlah_kelas' => $kelas->count(),
            'kelas' => $kelas,
            'jumlah_mutasi' => $mutasi->count(),
            'mutasi' => $mutasi,
            'murid_perempuan' => $murid->where('jenis_kelamin', 'P')->count(),
            'murid_laki' => $murid->where('jenis_kelamin', 'L')->count(),
            'siswa_yatim_piatu' => $siswa_yatim_piatu->count(),
            'tahun' => $tahun->filter(function ($value) {
                return $value->status === 'aktif';
            }),
        ]);
    }

    public function move_students(Request $request)
    {
        foreach ($request['daftar'] as $item) {
            Student::where('id', $item)->update(['group_id' => $request['group_id']]);
        }
        return redirect('/admin/grup');
    }

    public function dad_form(Dad $dad)
    {
        return view('admin/info_siswa/ayah', [
            'title' => 'Data Ayah Siswa',
            'res' => $dad
        ]);
    }

    public function edit_dad(Request $request, Dad $dad)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required',
            'kewarganegaraan' => 'required|string',
            'pekerjaan' => 'required|string',
            'pendidikan' => 'required',
            'alamat' => 'required|string|max:200',
            'nomor_hp' => 'required|string|max:16|regex:/[0-9]/',
            'status' => 'required',
        ]);
        Dad::where('uri', $dad->uri)->update($validated);
        return redirect('/dashboard')->with('success', 'Data ayah siswa berhasil diperbarui');
    }

    public function mom_form(Mom $mom)
    {
        return view('admin/info_siswa/ibu', [
            'title' => 'Data Ibu Siswa',
            'res' => $mom
        ]);
    }

    public function edit_mom(Request $request, Mom $mom)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required',
            'kewarganegaraan' => 'required|string',
            'pekerjaan' => 'required|string',
            'pendidikan' => 'required',
            'alamat' => 'required|string|max:200',
            'nomor_hp' => 'required|string|max:16|regex:/[0-9]/',
            'status' => 'required',
        ]);
        Mom::where('uri', $mom->uri)->update($validated);
        return redirect('/dashboard')->with('success', 'Data ibu siswa berhasil diperbarui');
    }

    public function guardian_form(Guardian $guardian)
    {
        return view('admin/info_siswa/wali', [
            'title' => 'Data Wali Siswa',
            'res' => $guardian,
        ]);
    }

    public function edit_guardian(Request $request, Guardian $guardian)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'agama' => 'required',
            'kewarganegaraan' => 'required|string',
            'pekerjaan' => 'required|string',
            'pendidikan' => 'required',
            'alamat' => 'required|string|max:200',
            'nomor_hp' => 'required|string|max:16|regex:/[0-9]/',
        ]);
        Guardian::where('uri', $guardian->uri)->update($validated);
        return redirect('/dashboard')->with('success', 'Data wali siswa berhasil diperbarui');
    }

    public function bio_form(Biodata $biodata)
    {
        return view('admin/info_siswa/biodata', [
            'title' => 'Biodata Siswa',
            'res' => $biodata,
        ]);
    }

    public function edit_bio(Request $request, Biodata $biodata)
    {
        $validated = $request->validate([
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'anak_ke' => 'required|gt:0',
            'jlh_saudara' => 'nullable|gt:0',
            'saudara_tiri' => 'nullable|gt:0',
            'saudara_angkat' => 'nullable|gt:0',
            'bahasa' => 'required',
            'agama' => 'required',
            'ciri' => 'nullable|string',
            'kewarganegaraan' => 'required|string',
            'sekolah_asal' => 'required',
        ]);

        Biodata::where('uri', $biodata->uri)->update($validated);
        return redirect('/dashboard')->with('success', 'Biodata berhasil diperbarui!');
    }

    public function mutasi_form(Student $siswa)
    {
        return view('admin/info_siswa/mutasi', [
            'title' => 'Mutasi Siswa',
            'res' => $siswa,
        ]);
    }

    public function edit_mutasi(Request $request, Student $siswa)
    {
        $validated = $request->validate([
            'tujuan' => 'required|string|min:8',
            'alasan' => 'required',
            'tanggal_pindah' => 'required'
        ]);
        Mutation::updateOrCreate(
            ['student_id' => $siswa->id],
            $validated
        );

        return redirect('/dashboard')->with('success', 'Siswa berhasil dimutasi');
    }

    public function list_mutasi()
    {
        return view('admin/info_siswa/list_mutasi', [
            'title' => 'Daftar Mutasi Siswa',
            'res' => Mutation::all(),
            'siswa' => Student::all()
        ]);
    }
}
