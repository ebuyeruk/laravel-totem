<?php

namespace Ebuyer\Totem\Database;

use Illuminate\Database\Migrations\Migration;

abstract class TotemMigration extends Migration
{
    protected $connection = TOTEM_DATABASE_CONNECTION;
}
