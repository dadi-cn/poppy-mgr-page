<?php

namespace Demo\Models;

use Eloquent;

class DemoDb extends Eloquent
{
    protected $table = 'demo_db';

    protected $fillable = [
        'tiny_integer',
        'u_integer',
        'var_char_20',
        'char_20',
        'text',
        'decimal',
    ];

}
