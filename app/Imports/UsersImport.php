<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Hash;
class UsersImport implements ToModel, WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id'            =>$row['id'],
            'user_id'       => $row['user_id'],
            'fname'         => $row['fname'], 
            'lname'         => $row['lname'], 
            'email'         => $row['email'], 
            'password'      => Hash::make($row['password']),
            'role_as'       => $row['role_as'], 
            'phone'         => $row['phone'], 
            'total-charge'  => $row['total-charge'], 
            
        ]);
    }
    public function rules(): array
    {
        return [
            'id' => 'required',

             // Above is alias for as it always validates in batches
             '*.id' => 'required',

            'user_id' => 'required',

             // Above is alias for as it always validates in batches
             '*.user_id' => 'required|unique:users',
        
            'fname' => 'required',

             // Above is alias for as it always validates in batches
             '*.fname' => 'required',

            'lname' => 'required',

             // Above is alias for as it always validates in batches
             '*.lname' => 'required',

            'email' => 'required',

             // Above is alias for as it always validates in batches
             '*.email' => 'required|email|unique:users',

            'password' => 'required',

             // Above is alias for as it always validates in batches
             '*.password' => 'required',

            'role_as' => 'required',

             // Above is alias for as it always validates in batches
             '*.role_as' => 'required',

            'phone' => 'required',

             // Above is alias for as it always validates in batches
             '*.phone' => 'required',

            'total-charge' => 'required',

             // Above is alias for as it always validates in batches
             '*.total-charge' => 'required',
             
        ];
    }
}
