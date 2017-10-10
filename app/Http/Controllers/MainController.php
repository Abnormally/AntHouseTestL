<?php

namespace App\Http\Controllers;

use App\Student;
use Cookie;
use Faker\Factory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request) {
        $cookie = $request->cookie('sort');

        if (!$cookie) {
            $options = [
                'column' => 'points',
                'direction' => 'desc',
                'amount' => 50
            ];

            $cookie = Cookie::make('sort', json_encode($options));
            Cookie::queue($cookie);

            $options = json_decode(json_encode($options));
        } else {
            $options = json_decode($cookie);
        }

        return view('index', [
            'students' => Student::getPagination($options->column, $options->direction, $options->amount),
            'sort' => $options
        ]);
    }

    public function getStudent($id) {
        return Student::find($id);
    }

    public function setSortCookie($column, $direction, $amount = 50) {
        Cookie::unqueue('sort');

        $options = ['column' => $column,
            'direction' => $direction,
            'amount' => $amount
        ];

        Cookie::queue(Cookie::make('sort', json_encode($options)));

        return redirect()->back();
    }

    public function createStudents($amount) {
        $faker = Factory::create();

        for ($i = 0; $i < $amount; $i++)
        {
            $student = \App\Student::create([
                'email' => $faker->safeEmail,
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'birth' => $faker->date(),
                'squad' => $faker->text(5),
                'sex' => $faker->boolean(),
                'foreign' => $faker->boolean(25),
                'points' => $faker->biasedNumberBetween(50, 300)
            ]);
        }
    }
}
