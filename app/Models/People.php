<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $table = 'people';  // Define the table name

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'ip_address',
    ];  // Specify the fillable columns
}
