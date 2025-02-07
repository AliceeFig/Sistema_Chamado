<?php



namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Chamada[] $chamadas
 */
class User extends Authenticatable
{

    use HasFactory, Notifiable, HasRoles;


    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name',

        'email',

        'password',

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];



    /**

     * Get the chamadas for the user.

     */

    public function chamadas()

    {

        return $this->hasMany(Chamada::class);

    }

}
