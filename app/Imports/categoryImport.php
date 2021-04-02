<?php

namespace App\Imports;

use App\category;
use Maatwebsite\Excel\Concerns\ToModel;

class categoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new category([
            'category_name' => $row[1],
            'slug' => $row[2],
        ]);
    }
}
