<?php

namespace App\Exports;
use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return  User::commonFunctionMethod(User::select(
            'id',
            'name',
            'email'),
            $this->request, true, null, null, true);
    }

    public function headings():array
    {
        return[
            'ID',
            'Name',
            'Email'
        ];
    }
}
