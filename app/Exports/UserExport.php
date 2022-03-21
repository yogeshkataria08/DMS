<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Headings
    */
    public function headings():array
    {
        return[
            "First Name",
            "Last Name",
            "Email",
            "Created at",
            "Deleted at"
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('first_name','last_name','email','created_at','deleted_at')->whereNotIn('role', ['1'])->get();
    }
}
