<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use OpenApi\Annotations as OA;
/**
 * class Interior.  
 * 
 * @author kenlie 
 * 
 * @OA\Schema(
 *     description="Interior model",
 *     title="Interior model",
 *     required={"name", "produced"},
 *     @OA\Xml(
 *         name="Interior"
 *      )
 * )
 */
class Interior extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'interiors';
    protected $fillable = [
        'name',
        'producer',
        'type',
        'year_produced',
        'image',
        'description',
        'price',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function data_adder(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }
}
