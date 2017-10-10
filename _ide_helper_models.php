<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Student
 *
 * @property int $id
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property string $birth
 * @property string $squad
 * @property int $sex
 * @property int $foreign
 * @property int $points
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereForeign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereSquad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 */
	class Student extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

