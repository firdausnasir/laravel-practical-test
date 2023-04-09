<?php

namespace Database\Seeders;

use App\Models\FormInput;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FormInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Name', 'type' => 'input', 'attributes' => [
                'type'        => 'text',
                'name'        => 'name',
                'placeholder' => 'Enter your name',
                'required'    => 'true',
            ]],
            ['name' => 'Phone Number', 'type' => 'input', 'attributes' => [
                'type'        => 'text',
                'name'        => 'phone',
                'placeholder' => 'Enter your phone number',
                'required'    => 'true',
            ]],
            ['name' => 'Date of Birth', 'type' => 'input', 'attributes' => [
                'type'     => 'date',
                'name'     => 'dob',
                'required' => 'true',
            ]],
            ['name' => 'Gender', 'type' => 'input', 'attributes' => [
                [
                    'type'  => 'radio',
                    'name'  => 'gender',
                    'value' => 'male',
                ],
                [
                    'type'  => 'radio',
                    'name'  => 'gender',
                    'value' => 'female',
                ],
            ]],
        ];

        foreach ($data as $item) {
            $formInput = FormInput::create(Arr::only($item, ['name', 'type']));

            collect(Arr::get($item, 'attributes', []))
                ->each(function ($attribute, $key) use ($formInput) {
                    if (!is_array($attribute)) {
                        $attribute = [$key => $attribute];
                    }

                    $items = [];
                    foreach ($attribute as $secondKey => $item) {
                        $items[] = ['name' => $secondKey, 'value' => $item];
                    }

                    $formInput->formAttributes()->createMany($items);
                })->toArray();
        }
    }
}
