<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getAllUsers($id = NULL)
    {
        if ($id == NULL) {
            return DB::table("users")->get();
        } else {
            return DB::table("users")->where("id", $id)->get();
        }
    }

    public static function userUpdate($data)
    {
        DB::table("users")->where('id', $data["id"])->update([
            "name" => $data["name"],
            "surname" => $data["surname"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "password" => Hash::make($data["password"]),
            "role" => $data["role"],
            "updated_at" => now(),
        ]);
    }
}
