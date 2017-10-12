<?php

namespace App\Http\Controllers;

use App\Student;
use Cookie;
use Faker\Factory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Returns index page with students sorted by exam points
     *
     * @param Request $request
     * @param bool $search
     * @param string $query
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $search = false, $query = "") {
        $cookie = $request->cookie('sort');

        if (!$cookie) {
            $options = [
                'column' => 'points',
                'direction' => 'desc',
                'amount' => 50
            ];

            $cookie = Cookie::make('sort', json_encode($options));
            Cookie::queue($cookie);

            $options = (object) $options;
        } else {
            $options = json_decode($cookie);
        }

        return view('index', [
            'students' => $search ?
                Student::getSearchPagination($query, $options->column, $options->direction, $options->amount)
                : Student::getPagination($options->column, $options->direction, $options->amount),
            'sort' => $options
        ]);
    }

    public function search(Request $request) {
        if (!$request->has('query') && !$request->hasCookie('search')) return redirect()->route('index');

        $query = $request->get('query');
        $cookie = $request->cookie('search');

        if ($query) {
            Cookie::queue(Cookie::make('search', $query));
            return $this->index($request, true, $query);
        }

        return $this->index($request, true, $cookie);
    }

    /**
     * Returns student
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function getStudent($id) {
        return Student::find($id);
    }

    /**
     * Set sorting cookie and redirects back to the page
     *
     * @param string $column
     * @param string $direction
     * @param int $amount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setSortCookie($column, $direction, $amount = 50) {
        Cookie::unqueue('sort');

        $options = ['column' => $column,
            'direction' => $direction,
            'amount' => $amount
        ];

        Cookie::queue(Cookie::make('sort', json_encode($options)));

        return redirect()->back();
    }

    /**
     * Return register page with student or object with empty fields
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registrationPage(Request $request) {
        if ($request->hasCookie('registered')) {
            $student = Student::find(json_decode($request->cookie('registered'))->id);
        } else {
            $student = (object) [
                "firstName" => '',
                "lastName" => '',
                "sex" => '',
                "squad" => '',
                "email" => '',
                "points" => '',
                "birth" => '',
                "foreign" => ''
            ];
        }

        return view('students.register', [
            'student' => $student
        ]);
    }

    /**
     * Creates or updates student
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registration(Request $request) {
        $request->validate([
            "firstName" => ['bail', 'required', 'alpha', 'min:2', 'max:100'],
            "lastName" => ['bail', 'required', 'alpha', 'min:2', 'max:100'],
            "sex" => ['bail', 'required', 'boolean'],
            "squad" => ['bail', 'required', 'alpha_num', 'min:2', 'max:5'],
            "email" => ['bail', 'required', 'email', 'max:200'],
            "points" => ['bail', 'required', 'integer', 'min:0', 'max:300'],
            "birth" => ['bail', 'required', 'date'],
            "foreign" => ['bail', 'required', 'boolean']
        ]);

        if ($request->hasCookie('registered')) {
            $registered = json_decode($request->cookie('registered'));
            $student = Student::find($registered->id);
            Cookie::unqueue('registered');

            if ($registered->email !== $student->email) {
                $request->validate([
                    "email" => 'unique:students'
                ]);
            }

            $student->update([
                'email' => $request->get('email'),
                'firstName' => $request->get('firstName'),
                'lastName' => $request->get('lastName'),
                'birth' => $request->get('birth'),
                'squad' => $request->get('squad'),
                'sex' => $request->get('sex'),
                'foreign' => $request->get('foreign'),
                'points' => $request->get('points')
            ]);
        } else {
            $request->validate([
                "email" => 'unique:students'
            ]);

            $student = Student::create([
                'email' => $request->get('email'),
                'firstName' => $request->get('firstName'),
                'lastName' => $request->get('lastName'),
                'birth' => $request->get('birth'),
                'squad' => $request->get('squad'),
                'sex' => $request->get('sex'),
                'foreign' => $request->get('foreign'),
                'points' => $request->get('points')
            ]);
        }

        Cookie::queue(Cookie::make('registered', json_encode([
            'id' => $student->id,
            'email' => $student->email
        ]), 5256000));

        return redirect()->route('index');
    }

    /**
     * Creates students
     *
     * @param integer $amount
     */
    public function createStudents($amount) {
        $faker = Factory::create();

        for ($i = 0; $i < $amount; $i++)
        {
            Student::create([
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
