<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SettingsEmailRequest;
use App\Http\Requests\Account\SettingsInfoRequest;
use App\Http\Requests\Account\SettingsPasswordRequest;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterListJob;
use App\Models\Perpetrator;
use App\Models\FileUpload;
use App\Models\PerpetratorAddress;
use App\Models\PerpetratorPersonalInfo;
use App\Models\PerpetratorCriminalOffense;
use App\Models\IndonesiaProvince;
use App\Models\IndonesiaCity;
use App\Models\IndonesiaDistrict;
use App\Models\IndonesiaVillage;
use App\Models\MasterListCrimeOfPerpetratorTarget;
use App\Models\MasterListCrimeOfPotentialTarget;
use App\Models\MasterListEquipment;
use App\Models\MasterListHowGetEquipment;
use App\Models\MasterListMotive;
use App\Models\MasterListTimePattern;
use App\Models\MasterListVehicle;
use App\Models\MasterListCrimeMode;
use App\Models\Offender;
use App\Models\OffenderCrimeIndication;
use App\Models\OffenderInternalVisit;
use App\Models\OffenderExternalVisit;
use App\Models\User;

use DataTables;
use Alert;
use Illuminate\Support\Facades\Validator;

class PerpetratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function detail($id)
    {
        $info = auth()->user()->info;
        $jobs = MasterListJob::get();

        $perpetrator = Perpetrator::where('id', $id)->first();
        $image = FileUpload::where(['file_uploadable_type' => 'App/Model/Perpetrator', 'file_uploadable_id' => $id])->first();
        $offenders = Offender::has('offenderCrimeIndication')->with('offenderCrimeIndication.equipment', 'offenderCrimeIndication.motive', 'offenderExternalVisit', 'offenderInternalVisit')->where('perpetrator_id', $id)->get();
        // get the default inner page
        $active_offenders = $offenders->whereIn('status', [1, 2])->count();
        $closed_offenders = $offenders->where('status', 3)->count();
        return view('pages.account.overview.perpetrator', compact('offenders', 'perpetrator', 'active_offenders', 'closed_offenders', 'image'));
    }

    public function addOffender(Request $request)
    {
        $admin = User::where('id', auth()->user()->id)->first();

        $offender = Offender::create([
            'status' => 1, //pendataan
            'perpetrator_id' => $request->perpetrator_id,
            'type' => $request->offender_type,
            'admin_id' => auth()->user()->id,
            'polres_id' => $admin->polres_code,
            'polsek_id' => $admin->polsek_code
        ]);

        return response()->json(['url' => url('/account/perpetrator/offender/' . $offender->id . '/create')]);
    }

    public function addOffenderMobile($perpetrator, $type)
    {
        $admin = User::where('id', auth()->user()->id)->first();

        $offender = Offender::create([
            'status' => 1, //pendataan
            'perpetrator_id' => $perpetrator,
            'type' => $type,
            'admin_id' => auth()->user()->id,
            'polres_id' => $admin->polres_code,
            'polsek_id' => $admin->polsek_code
        ]);

        return redirect('/account/perpetrator/offender/' . $offender->id . '/create');
    }

    public function createOffenderForm($id)
    {
        $info = auth()->user()->info;
        $offender = Offender::where('id', $id)->first();
        $perpetrator_info = Perpetrator::where('id', $offender->perpetrator_id)->first();

        $jobs = MasterListJob::get();
        $provinces = IndonesiaProvince::get();

        $crime_perpetrator_targets = MasterListCrimeOfPerpetratorTarget::get();
        $crime_potential_targets = MasterListCrimeOfPotentialTarget::get();
        $equipments = MasterListEquipment::get();
        $how_get_equipments = MasterListHowGetEquipment::get();
        $motives = MasterListMotive::get();
        $time_patterns = MasterListTimePattern::get();
        $vehicles = MasterListVehicle::get();
        $crime_modes = MasterListCrimeMode::get();

        if ($offender->type == 1)
            $crimes = MasterListCrimeOfPotentialTarget::get();

        if ($offender->type == 2)
            $crimes = MasterListCrimeOfPerpetratorTarget::get();

        // get the default inner page
        return view('pages.account.overview.create-perpetrator-offender', compact('perpetrator_info', 'offender', 'jobs', 'provinces', 'crimes', 'crime_perpetrator_targets', 'crime_potential_targets', 'equipments', 'how_get_equipments', 'motives', 'time_patterns', 'vehicles', 'crime_modes'));
    }

    public function updateDataKejadian(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data_offender = Offender::where('id', $request->offender_id)->first();
            if ($data_offender->type == 1)
                $crime_key = 'App/Model/MasterListCrimeOfPotentialTarget';

            if ($data_offender->type == 2)
                $crime_key = 'App/Model/MasterListCrimeOfPerpetratorTarget';

            $offender_crime_indication = OffenderCrimeIndication::updateOrCreate([
                'offender_id' => $request->offender_id,
            ], [
                'crime_key' => $crime_key,
                'crime_id' => $request->crime_id,
                'date_incident' => $request->date_incident,
                'time_id' => $request->time_id,
                'location_incident' => $request->location_incident,
                'rt' => $request->location_rt,
                'rw' => $request->location_rw,
                'province_id' => $request->province_location,
                'city_id' => $request->city_location,
                'district_id' => $request->district_location,
                'subdistrict_id' => $request->village_location,
                'is_indication_alchohol' => $request->is_indication_alchohol,
                'how_to_get_alchohol' => $request->how_to_get_alchohol,
                'is_indication_drug' => $request->is_indication_drug,
                'how_to_get_drug' => $request->how_to_get_drug,
                'equipment_id' => $request->equipment_id,
                'how_get_equipment_id' => $request->how_to_get_equipment_id,
                'motives_id' => $request->motives_id,
                'crime_mode_id' => $request->crime_mode_id,
                'vehicle_id' => $request->vehicle_id,
                'plat_number' => $request->plat_number,
                'other_notes' => $request->other_notes,
                'is_gang_crime' => $request->is_gang_crime ?? 0,
                'lead_gang_name' => $request->lead_gang_name,
                'gang_crime_name' => $request->gang_crime_name,
                'total_gang_member' => $request->total_gang_member,
            ]);

            // ----------------------------------- START OF UPLOAD FILE ----------------------------------- //
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $folder = "/images/data-kejadian";
                    $upload = Storage::disk('public_uploads')->putFile($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/OffenderCrimeIndication',
                            'file_uploadable_id' => $offender_crime_indication->id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE ----------------------------------- //

            \DB::commit();
            // return response()->json(['url'=>url('/account/settings/data-kejadian/'.$perpetrator_info->id.'')]);
            return redirect()->route('perpetrator.detail', ['id' => $data_offender->perpetrator_id]);
        } catch (\Exception $e) {
            \DB::rollback();
            // throw $e;
            Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            return redirect()->back();
        }
    }

    public function editOffender($id)
    {
        $info = auth()->user()->info;
        $offender = Offender::with('offenderCrimeIndication', 'offenderExternalVisit', 'offenderInternalVisit')->where('id', $id)->first();
        $perpetrator_info = Perpetrator::where('id', $offender->perpetrator_id)->first();

        $jobs = MasterListJob::get();
        $provinces = IndonesiaProvince::get();
        $selected_province = IndonesiaProvince::where('code', $offender->offenderCrimeIndication->province_id)->first();
        $selected_city = IndonesiaCity::where('code', $offender->offenderCrimeIndication->city_id)->first();
        $selected_district = IndonesiaDistrict::where('code', $offender->offenderCrimeIndication->district_id)->first();
        $selected_village = IndonesiaVillage::where('code', $offender->offenderCrimeIndication->subdistrict_id)->first();

        $offender_images = FileUpload::where('file_uploadable_type', 'App/Model/OffenderCrimeIndication')->where('file_uploadable_id', $offender->offenderCrimeIndication->id)->get();
        $internal_visit_images = [];
        $external_visit_images = [];

        if ($offender->offenderInternalVisit)
            $internal_visit_images = FileUpload::where('file_uploadable_type', 'App/Model/OffenderInternalVisit')->where('file_uploadable_id', $offender->offenderInternalVisit->id)->get();

        if ($offender->offenderExternalVisit)
            $external_visit_images = FileUpload::where('file_uploadable_type', 'App/Model/OffenderExternalVisit')->where('file_uploadable_id', $offender->offenderExternalVisit->id)->get();

        $crime_perpetrator_targets = MasterListCrimeOfPerpetratorTarget::get();
        $crime_potential_targets = MasterListCrimeOfPotentialTarget::get();
        $equipments = MasterListEquipment::get();
        $how_get_equipments = MasterListHowGetEquipment::get();
        $motives = MasterListMotive::get();
        $time_patterns = MasterListTimePattern::get();
        $vehicles = MasterListVehicle::get();
        $crime_modes = MasterListCrimeMode::get();

        if ($offender->type == 1)
            $crimes = MasterListCrimeOfPotentialTarget::get();

        if ($offender->type == 2)
            $crimes = MasterListCrimeOfPerpetratorTarget::get();

        // get the default inner page
        return view('pages.account.overview.edit-perpetrator-offender', compact('perpetrator_info', 'offender', 'offender_images', 'internal_visit_images', 'external_visit_images', 'jobs', 'provinces', 'selected_province', 'selected_city', 'selected_district', 'selected_village', 'crimes', 'crime_perpetrator_targets', 'crime_potential_targets', 'equipments', 'how_get_equipments', 'motives', 'time_patterns', 'vehicles', 'crime_modes'));
    }

    public function updateOffender(Request $request)
    {
        \DB::beginTransaction();
        try {

            $data_offender = Offender::where('id', $request->offender_id)->first();
            if ($data_offender->type == 1)
                $crime_key = 'App/Model/MasterListCrimeOfPotentialTarget';

            if ($data_offender->type == 2)
                $crime_key = 'App/Model/MasterListCrimeOfPerpetratorTarget';

            $offender_crime_indication = OffenderCrimeIndication::updateOrCreate([
                'offender_id' => $request->offender_id,
            ], [
                'crime_key' => $crime_key,
                'crime_id' => $request->crime_id,
                'date_incident' => $request->date_incident,
                'time_id' => $request->time_id,
                'location_incident' => $request->location_incident,
                'rt' => $request->location_rt,
                'rw' => $request->location_rw,
                'province_id' => $request->province_location,
                'city_id' => $request->city_location,
                'district_id' => $request->district_location,
                'subdistrict_id' => $request->village_location,
                'is_indication_alchohol' => $request->is_indication_alchohol,
                'how_to_get_alchohol' => $request->how_to_get_alchohol,
                'is_indication_drug' => $request->is_indication_drug,
                'how_to_get_drug' => $request->how_to_get_drug,
                'equipment_id' => $request->equipment_id,
                'how_get_equipment_id' => $request->how_to_get_equipment_id,
                'motives_id' => $request->motives_id,
                'crime_mode_id' => $request->crime_mode_id,
                'vehicle_id' => $request->vehicle_id,
                'plat_number' => $request->plat_number,
                'other_notes' => $request->other_notes,
                'is_gang_crime' => $request->is_gang_crime ?? 0,
                'lead_gang_name' => $request->lead_gang_name,
                'gang_crime_name' => $request->gang_crime_name,
                'total_gang_member' => $request->total_gang_member,
            ]);

            // ----------------------------------- START OF UPLOAD FILE DATA KEJADIAN----------------------------------- //
            if ($request->old_files) {
                $delete_all_old_images = FileUpload::whereIn('file_uploadable_id', [$offender_crime_indication->id])->whereIn('file_uploadable_type', ['App/Model/OffenderCrimeIndication'])->delete();

                foreach ($request->old_files as $old_file) {
                    $reupload_old_file = FileUpload::create([
                        'file_uploadable_type' => 'App/Model/OffenderCrimeIndication',
                        'file_uploadable_id' => $offender_crime_indication->id,
                        'file_path' => $old_file
                    ]);
                }
            }

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $folder = "/images/data-kejadian";
                    $upload = Storage::disk('public_uploads')->putFile($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/OffenderCrimeIndication',
                            'file_uploadable_id' => $offender_crime_indication->id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE DATA KEJADIAN----------------------------------- //



            $offender_internal_visit = OffenderInternalVisit::updateOrCreate([
                'offender_id' => $request->offender_id,
            ], [
                'date_visit' => $request->internal_date_visit,
                'time_visit_start_at' => $request->internal_time_visit_start_at,
                'time_visit_end_at' => $request->internal_time_visit_end_at,
                'pic_name' => $request->internal_pic_name,
                'pic_position' => $request->internal_pic_position,
                'pic_instance' => $request->internal_pic_instance,
                'pic_phone_number' => $request->internal_pic_phone_number,
                'activity' => $request->internal_activity
            ]);

            // ----------------------------------- START OF UPLOAD FILE DATA INTERNAL VISIT (SAMBANG INTERNAL) ----------------------------------- //
            if ($request->old_internal_visit_images) {
                $delete_all_old_images = FileUpload::whereIn('file_uploadable_id', [$offender_internal_visit->id])->whereIn('file_uploadable_type', ['App/Model/OffenderInternalVisit'])->delete();

                foreach ($request->old_internal_visit_images as $old_internal_visit_file) {
                    $reupload_old_file = FileUpload::create([
                        'file_uploadable_type' => 'App/Model/OffenderInternalVisit',
                        'file_uploadable_id' => $offender_internal_visit->id,
                        'file_path' => $old_internal_visit_file
                    ]);
                }
            }

            if ($request->hasFile('files_internal')) {
                foreach ($request->file('files_internal') as $file) {
                    $folder = "/images/data-sambang-internal";
                    $upload = Storage::disk('public_uploads')->putFile($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/OffenderInternalVisit',
                            'file_uploadable_id' => $offender_internal_visit->id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE DATA INTERNAL VISIT (SAMBANG INTERNAL) ----------------------------------- //



            $offender_external_visit = OffenderExternalVisit::updateOrCreate([
                'offender_id' => $request->offender_id,
            ], [
                'date_visit' => $request->external_date_visit,
                'time_visit_start_at' => $request->external_time_visit_start_at,
                'time_visit_end_at' => $request->external_time_visit_end_at,
                'pic_name' => $request->external_pic_name,
                'pic_position' => $request->external_pic_position,
                'pic_instance' => $request->external_pic_instance,
                'pic_phone_number' => $request->external_pic_phone_number,
                'activity' => $request->external_activity
            ]);

            // ----------------------------------- START OF UPLOAD FILE DATA EXTERNAL VISIT (SAMBANG EKSTERNAL) ----------------------------------- //
            if ($request->old_external_visit_images) {
                $delete_all_old_images = FileUpload::whereIn('file_uploadable_id', [$offender_external_visit->id])->whereIn('file_uploadable_type', ['App/Model/OffenderExternalVisit'])->delete();

                foreach ($request->old_external_visit_images as $old_external_visit_file) {
                    $reupload_old_file = FileUpload::create([
                        'file_uploadable_type' => 'App/Model/OffenderExternalVisit',
                        'file_uploadable_id' => $offender_external_visit->id,
                        'file_path' => $old_external_visit_file
                    ]);
                }
            }

            if ($request->hasFile('files_external')) {
                foreach ($request->file('files_external') as $file) {
                    $folder = "/images/data-sambang-eksternal";
                    $upload = Storage::disk('public_uploads')->putFile($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/OffenderExternalVisit',
                            'file_uploadable_id' => $offender_external_visit->id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE DATA EXTERNAL VISIT (SAMBANG EKSTERNAL) ----------------------------------- //



            if ($offender_internal_visit || $offender_external_visit) {
                $data_offender->update([
                    'status' => 2, //tindakan
                ]);
            }

            if ($request->adjudication) {
                $data_offender->update([
                    'status' => 3, //ditutup
                    'adjudication' => $request->adjudication
                ]);
            }

            \DB::commit();
            Alert::toast('Data berhasil diperbarui', 'success')->padding('10px');
            return redirect()->route('perpetrator.detail', ['id' => $data_offender->perpetrator_id]);
        } catch (\Exception $e) {
            \DB::rollback();
            // throw $e;
            Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            return redirect()->back();
        }
    }


    public function editProfile($id)
    {
        $info = auth()->user()->info;
        $offender = Offender::with('offenderCrimeIndication', 'offenderExternalVisit', 'offenderInternalVisit')->where('id', $id)->first();
        $perpetrator_info = Perpetrator::with('perpetratorPersonalInfo', 'perpetratorAddress')->where('id', $id)->first();

        $parent_address = PerpetratorAddress::where('perpetrator_id', $id)->where('type', 1)->first();

        $selected_province_parent = IndonesiaProvince::where('code', @$parent_address->province_id)->first();
        $selected_city_parent = IndonesiaCity::where('code', @$parent_address->city_id)->first();
        $selected_district_parent = IndonesiaDistrict::where('code', @$parent_address->district_id)->first();
        $selected_village_parent = IndonesiaVillage::where('code', @$parent_address->subdistrict_id)->first();

        $perpetrator_address = PerpetratorAddress::where('perpetrator_id', $id)->where('type', 2)->first();
        $selected_province_perpetrator = IndonesiaProvince::where('code', @$perpetrator_address->province_id)->first();
        $selected_city_perpetrator = IndonesiaCity::where('code', @$perpetrator_address->city_id)->first();
        $selected_district_perpetrator = IndonesiaDistrict::where('code', @$perpetrator_address->district_id)->first();
        $selected_village_perpetrator = IndonesiaVillage::where('code', @$perpetrator_address->subdistrict_id)->first();

        $profile_images = FileUpload::where('file_uploadable_type', 'App/Model/Perpetrator')->where('file_uploadable_id', $id)->get();

        $jobs = MasterListJob::get();
        $provinces = IndonesiaProvince::get();

        $perpetrator_criminal_offenses = PerpetratorCriminalOffense::where('perpetrator_id', $id)->get();

        // get the default inner page
        return view('pages.account.overview.edit-profile', compact('profile_images', 'perpetrator_info', 'offender', 'jobs', 'provinces', 'parent_address', 'selected_province_parent', 'selected_city_parent', 'selected_district_parent', 'selected_village_parent', 'perpetrator_address', 'selected_province_perpetrator', 'selected_city_perpetrator', 'selected_district_perpetrator', 'selected_village_perpetrator', 'perpetrator_criminal_offenses'));
    }

    public function updateProfile(Request $request)
    {
        $validasi = [
            'nik' => 'required|digits:16',
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'job_id' => 'required',
            'father_name' => 'required',
            'father_job' => 'required',
            'mother_name' => 'required',
            'mother_job' => 'required',
            'parent_address' => 'required',
            'province_parent' => 'required',
            'city_parent' => 'required',
            'district_parent' => 'required',
            'village_parent' => 'required',
        ];

        $validasi_message = [
            'nik.required' => 'NIK harus diisi',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
            'name.required' => 'Nama Lengkap harus diisi',
            'gender.required' => 'Jenis kelamin harus dipilih',
            'job_id.required' => 'Pekerjaan harus dipilih',
            'father_name.required' => 'Nama ayah harus di isi',
            'father_job.required' => 'Pekerjaan ayah harus di pilih',
            'mother_name.required' => 'Nama ibu harus di isi',
            'mother_job.required' => 'Pekerjaan ibu harus di pilih',
            'parent_address.required' => 'Alamat tinggal orang tua',
            'province_parent.required' => 'Provinsi harus di pilih',
            'district_parent.required' => 'Kecamatan harus di pilih',
            'village_parent.required' => 'Kelurahan harus di pilih',
        ];

        $validator = Validator::make(
            $request->all(),
            $validasi,
            $validasi_message
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        \DB::beginTransaction();
        try {

            $perpetrator = Perpetrator::updateOrCreate([
                'id' => $request->perpetrator_id
            ], [
                'nik' => $request->nik,
                'name' => $request->name,
                'date_of_birth' => $request->dob,
                'gender' => $request->gender,
                'job_id' => $request->job_id,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
            ]);

            $perpetrator_personal_info = PerpetratorPersonalInfo::updateOrCreate([
                'perpetrator_id' => $request->perpetrator_id,
            ], [
                'father_name' => $request->father_name,
                'father_job' => $request->father_job,
                'mother_name' => $request->mother_name,
                'mother_job' => $request->mother_job,
                'guardian_name' => $request->guardian_name,
                'guardian_job' => $request->guardian_job,
            ]);

            if ($request->parent_address) {
                PerpetratorAddress::updateOrCreate([
                    'perpetrator_id' => $request->perpetrator_id,
                    'type' => 1, //alamat orang tua
                ], [
                    'address' => $request->parent_address,
                    'rt' => $request->parent_rt,
                    'rw' => $request->parent_rw,
                    'province_id' => $request->province_parent,
                    'city_id' => $request->city_parent,
                    'district_id' => $request->district_parent,
                    'subdistrict_id' => $request->village_parent,
                ]);
            }

            if ($request->perpetrator_address) {
                $perpetrator_address = PerpetratorAddress::updateOrCreate([
                    'perpetrator_id' => $request->perpetrator_id,
                    'type' => 2, //alamat pelaku
                ], [
                    'address' => $request->perpetrator_address,
                    'rt' => $request->perpetrator_rt,
                    'rw' => $request->perpetrator_rw,
                    'province_id' => $request->province_perpetrator,
                    'city_id' => $request->city_perpetrator,
                    'district_id' => $request->district_perpetrator,
                    'subdistrict_id' => $request->village_perpetrator,
                ]);
            }

            // ----------------------------------- START OF UPLOAD FILE DATA KEJADIAN----------------------------------- //
            if ($request->old_files) {
                $delete_all_old_images = FileUpload::whereIn('file_uploadable_id', [$request->perpetrator_id])->whereIn('file_uploadable_type', ['App/Model/Perpetrator'])->delete();

                foreach ($request->old_files as $old_file) {
                    $reupload_old_file = FileUpload::create([
                        'file_uploadable_type' => 'App/Model/Perpetrator',
                        'file_uploadable_id' => $request->perpetrator_id,
                        'file_path' => $old_file
                    ]);
                }
            }

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $folder = "/images/data-pribadi";
                    $upload = Storage::disk('public_uploads')->putFile($folder, $file);

                    if ($upload) {
                        $upload_file = FileUpload::create([
                            'file_uploadable_type' => 'App/Model/Perpetrator',
                            'file_uploadable_id' => $request->perpetrator_id,
                            'file_path' => $upload
                        ]);
                    }
                }
            }
            // ----------------------------------- END OF UPLOAD FILE DATA KEJADIAN----------------------------------- //

            // ------------- SAVE DETAIL TINDAK PIDANA ------------------------
            PerpetratorCriminalOffense::where('perpetrator_id', $request->perpetrator_id)->delete();

            $police_station = $request->police_station;
            $crime = $request->crime;
            $adjudication = $request->adjudication;
            $notes = $request->crime_notes;

            foreach ($request->district_court ?? [] as $key => $dc) {
                $pco = new PerpetratorCriminalOffense;
                $pco->perpetrator_id = $request->perpetrator_id;
                $pco->district_court = $dc;
                $pco->police_station = $police_station[$key];
                $pco->crime = $crime[$key];
                $pco->adjudication = $adjudication[$key];
                $pco->notes = $notes[$key];
                $pco->save();
            }


            \DB::commit();
            Alert::toast('Data berhasil diperbarui', 'success')->padding('10px');
            return redirect()->route('perpetrator.detail', ['id' => $request->perpetrator_id]);
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
            // Alert::toast('Terjadi kesalahan', 'error')->padding('10px');
            // return redirect()->back();
        }
    }

    public function deleteOffender($id)
    {
        \DB::beginTransaction();

        try {
            Offender::where('id', $id)->delete();
            OffenderCrimeIndication::where('offender_id', $id)->delete();
            OffenderExternalVisit::where('offender_id', $id)->delete();
            OffenderInternalVisit::where('offender_id', $id)->delete();
            \DB::commit();

            return back();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }

    public function deletePerpetrator($id)
    {
        \DB::beginTransaction();
        try {
            $offenders = Offender::has('offenderCrimeIndication')->with('offenderCrimeIndication.equipment', 'offenderCrimeIndication.motive', 'offenderExternalVisit', 'offenderInternalVisit')->where('perpetrator_id', $id)->get();
            if (count($offenders) > 0) {
                alert()->warning('Peringatan', 'Terdapat data kasus perlu di hapus terlebih dahulu !');
            } else {
                Offender::where('perpetrator_id', $id)->delete();
                alert()->success('Berhasil', 'Hapus data berhasil');
            }
            \DB::commit();
            return back();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }
}
