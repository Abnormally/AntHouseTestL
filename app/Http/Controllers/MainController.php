<?php

namespace App\Http\Controllers;

use App\Student;
use Faker\Factory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view('index', [
            'students' => Student::getPagination('points', 'desc')
        ]);
    }

    public function getStudent($id) {
        return Student::find($id);
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
