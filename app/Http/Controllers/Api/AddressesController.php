<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\Setting;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Api\ApiHelpersController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AddressesController extends ApiHelpersController
{
    public function getAll()
    {
        $userAddresses = Auth::guard('users')->user()->addresses()->cursor();
        $data = [];
        foreach ($userAddresses as $k => $address) {
            $data[$k]['id']           = $address->id;
            $data[$k]['full_address'] = $address->full_address;
            $data[$k]['is_default']   = $address->is_default;
        }
        return response()->api(true, 'successOperation', [], $data);
    }

    public function add(Request $request)
    {
        if (Auth::guard('users')->user()->addresses()->count() >= 10) {
            return response()->api(false, 'someErrorsHappened', 'reachMaxAddress');
        }
        $rules = [
            'building'  => ['required'],
            'street'    => ['required'],
            'floor'     => ['required'],
            'notes'     => ['nullable'],
            'area_id'   => ['required', 'integer', 'min:1', 'exists:areas,id'],
            'city_id'   => ['required', 'integer', 'min:1', 'exists:cities,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        if (Area::find($request->area_id)->city->id != $request->city_id) {
            return response()->api(false, 'someErrorsHappened', 'wrongParentCity');
        }
        if (Auth::guard('users')->user()->addresses()->count() == 0){
            $request->merge(['is_default'  => 1]);
        }
        Auth::guard('users')->user()->addresses()->create($request->all());
        return response()->api(true, 'successOperation');
    }

    public function getDetails(Request $request)
    {
        $rules = [
            'address_id' => ['required', 'integer', 'min:1', 'exists:user_addresses,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $address = UserAddress::find($request->address_id);
        if ($address->user_id != Auth::guard('users')->user()->id) {
            return response()->api(false, 'someErrorsHappened', 'notUserAddress');
        }
        $data = [];
        $data['id']          = $address->id;
        $data['building']    = $address->building;
        $data['street']      = $address->street;
        $data['floor']       = $address->floor;
        $data['notes']       = $address->notes;
        $data['area_id']     = $address->area_id;
        $data['city_id']     = $address->city_id;

        return response()->api(true, 'successOperation', [], $data);
    }

    public function update(Request $request)
    {
        $rules = [
            'address_id' => ['required', 'integer', 'min:1', 'exists:user_addresses,id'],
            'building'   => ['required'],
            'street'     => ['required'],
            'floor'      => ['required'],
            'notes'      => ['nullable'],
            'area_id'    => ['required', 'integer', 'min:1', 'exists:areas,id'],
            'city_id'    => ['required', 'integer', 'min:1', 'exists:cities,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        if (Area::find($request->area_id)->city->id != $request->city_id) {
            return response()->api(false, 'someErrorsHappened', 'wrongParentCity');
        }
        $address = UserAddress::find($request->address_id);
        if ($address->user_id != Auth::guard('users')->user()->id) {
            return response()->api(false, 'someErrorsHappened', 'notUserAddress');
        }
        $address->update($request->only(['building', 'street', 'floor', 'notes', 'area_id', 'city_id']));

        return response()->api(true, 'successOperation');
    }

    public function changeDefault(Request $request)
    {
        $rules = [
            'address_id' => ['required', 'integer', 'min:1', 'exists:user_addresses,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $address = UserAddress::find($request->address_id);
        if ($address->user_id != Auth::guard('users')->user()->id) {
            return response()->api(false, 'someErrorsHappened', 'notUserAddress');
        }
        if ($address->is_default == 1){
            return response()->api(false, 'someErrorsHappened', 'addressAlreadyDefault');
        }
        $address->update(['is_default' => 1]);
        Auth::guard('users')->user()->addresses()->whereNotIn('id', [$address->id])->update(['is_default' => 0]);
        return response()->api(true, 'successOperation');
    }

    public function delete(Request $request)
    {
        $rules = [
            'address_id' => ['required', 'integer', 'min:1', 'exists:user_addresses,id'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->api(false, 'someErrorsHappened', $validator->errors()->all());
        }
        $address = UserAddress::find($request->address_id);
        if ($address->user_id != Auth::guard('users')->user()->id) {
            return response()->api(false, 'someErrorsHappened', 'notUserAddress');
        }
        $addressesExceptDefault = Auth::guard('users')->user()->addresses()->whereNotIn('id', [$address->id]);
        if ($address->is_default == 1 && $addressesExceptDefault->count() > 0){
            $addressesExceptDefault->first()->update(['is_default' => 1]);
        }
        $address->delete();
        return response()->api(true, 'successOperation');
    }
}
