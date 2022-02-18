<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Scopes;

class Import_csv_log extends Model
{
    use HasFactory, Scopes,SoftDeletes;

    protected $table = 'import_csv_logs';

    protected $fillable = ['filename','file_path','model_name','error_log'];
}
