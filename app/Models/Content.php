<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string slug
 * @property string description
 * @property string body
 */
class Content extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title', 'slug', 'description', 'body'];

}
