<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function isAdmin()
    {
        return $this->adminstration_level > 0 ? true : false ;
    }
    public function isSuperAdmin()
    {
        return $this->adminstration_level > 1 ? true : false ;
    }
    // /////////////Ratings///////////////////
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function rated(Book $book)
    {
        return $this->ratings()->where('book_id',$book->id)->count() > 0;
    }
    public function bookRating(Book $book)
    {
        return $this->rated($book) ? $this->ratings()->where('book_id',$book->id)->first() : NULL;
    }
    // //////////////////Cart/////////////
    public function booksInCart()
    {
        return $this->belongsToMany(Book::class)->withPivot(['number_of_copies','bought','price'])->wherePivot('bought',FALSE);
    }

    public function ratedpurches()
    {
        return $this->belongsToMany(Book::class)->withPivot(['bought'])->wherePivot('bought',true);
    }
    public function purchedProduct()
    {
        return $this->belongsToMany(Book::class)->withPivot(['number_of_copies','bought','price','created_at'])->orderBy('pivot_created_at','desc')->wherePivot('bought' , true);
    }
}
