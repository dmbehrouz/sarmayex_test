<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string link
 * @property string group
 * @property string status
 * @property int position
 */
class DynamicLink extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'link', 'group', 'status', 'position'];
}
