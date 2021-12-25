<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Validators\Failure;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row[1]);
        $new_users = User::create([

            'email'             => $row['email'],
            'password'          => Hash::make($row['nim']),
            'roles'             => 'mahasiswa'

        ]);
        $new_users->mahasiswa()->create([
            'name'              => $row['name'],
            'nim'               => $row['nim'],
            'angkatan'          => $row['angkatan'],
            'jenis_kelamin'     => $row['jenis_kelamin'],
        ]);

        return $new_users;

    }

    public function rules(): array
    {
        return [
            "email" =>  [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (User::whereEmail($value)->count() > 0) {
                        $fail($attribute . ' is already used.');
                    }
                },
            ],
            "name"  => "required",
            "nim"   => [
                'required',
                'min:11',
                'max:12',
                function ($attribute, $value, $fail) {
                    if (Mahasiswa::whereNim($value)->count() > 0) {
                        $fail($attribute . ' is already used.');
                    }
                }
            ],
            "angkatan"      => "required|min:4|max:5",
            'jenis_kelamin' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name' => 'Name cannot be empty',
        ];
    }

    /**
     * @param Failure ...$failures
     * @throws ValidationException
     */
    public function onFailure(Failure ...$failures)
    {
        $exception = ValidationException::withMessages(collect($failures)->map->toArray()->all());

        throw $exception;
    }

}
