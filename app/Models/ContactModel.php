<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;

    protected $table = 'contact';

    static public function getContacts()
    {
        return self::select('*')
                ->orderBy('id', 'desc')
                ->paginate(10);
    }

    static public function getContact($id)
    {
        return self::find($id);
    }
}
