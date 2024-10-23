<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class categoryImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Category([
            'uuid' => Str::uuid(),
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'unique:categories,name',
        ];
    }
}
