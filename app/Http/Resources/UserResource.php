<?php

namespace App\Http\Resources;

use App\Models\MembershipUser;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $userMembershipActive = MembershipUser::whereUserId($this->id)->active()->first();
        return [
        'id'                 => $this->id,
        'membership_number'  => $this->membership_number,
        'name'               => $this->name,
        'phone'              => $this->phone,
        'gender'             => $this->gender,
        'verified'           => $this->verified,
        'image'              => $this->getFirstMediaUrl(),
        'email'              => $this->email,
        'birth_date'         => $this->birth_date,
        'nationality'        => (string) $this->nationality->name,
        'area_id'            => $this->area_id,
        'city_id'            => $this->city_id,
        'address'            => $this->address,
        'membership_name'    => $userMembershipActive ? $userMembershipActive->membership['name_' . app()->getLocale()] : loadOption('regular_membership_' . app()->getLocale()),
        'wallet'             => $this->wallet,
        'wallet_plus'        => $this->wallet_plus,
        'role'               => $this->role,
        'medical_decisions'  => $this->role == 'faculty-member' ? true : false,
        'token'              => $this->createToken('createToken')->plainTextToken,
        ];
    }
}
