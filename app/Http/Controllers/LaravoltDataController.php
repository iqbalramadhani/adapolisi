<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndonesiaProvince;
use App\Models\IndonesiaCity;
use App\Models\IndonesiaDistrict;
use App\Models\IndonesiaVillage;

class LaravoltDataController extends Controller
{
    public function getProvinces(Request $request) {
        $items = IndonesiaProvince::get();
        return response()->json($items);
    }
    
    public function getCities(Request $request, $province_code = null) {
        $items = IndonesiaCity::where('province_code', $request->province_code)->get();
        return response()->json($items);
    }

    public function getDistricts(Request $request, $city_code = null) {
        $items = IndonesiaDistrict::where('city_code', $request->city_code)->get();
        return response()->json($items);
    }

    public function getSubdistricts(Request $request, $district_code = null) {
        $items = IndonesiaVillage::where('district_code', $request->district_code)->get();
        return response()->json($items);
    }

    public function selectProvince(Request $request)
    {
        $provinces = [];
        if ($request->has('q')) {
            $search = $request->q;
            $provinces = IndonesiaProvince::select("code", "name")
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $provinces = IndonesiaProvince::get();
        }
        return response()->json($provinces);
    } 

    public function selectCity(Request $request)
    {
        $cities = [];
        $province_code = $request->province_code;
        if ($request->has('q')) {
            $search = $request->q;
            $cities = IndonesiaCity::select("code", "name")
                ->where('province_code', $province_code)
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $cities = IndonesiaCity::where('province_code', $province_code)->get();
        }
        return response()->json($cities);
    } 

    public function selectDistrict(Request $request)
    {
        $districts = [];
        $city_code = $request->city_code;
        if ($request->has('q')) {
            $search = $request->q;
            $districts = IndonesiaDistrict::select("code", "name")
                ->where('city_code', $city_code)
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $districts = IndonesiaDistrict::where('city_code', $city_code)->get();
        }
        return response()->json($districts);
    }

    public function selectVillage(Request $request)
    {
        $villages = [];
        $district_code = $request->district_code;
        if ($request->has('q')) {
            $search = $request->q;
            $villages = IndonesiaVillage::select("code", "name")
                ->where('district_code', $district_code)
                ->Where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $villages = IndonesiaVillage::where('district_code', $district_code)->limit(10)->get();
        }
        return response()->json($villages);
    }

}