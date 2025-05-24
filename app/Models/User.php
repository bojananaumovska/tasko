<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'username',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->name == $roleName;
    }
    public function hasAnyRole(array $roleNames)
{
    return $this->role && in_array($this->role->name, $roleNames);
}

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function acceptedTasks(){
        return $this->hasMany(Task::class, 'accepted_by_id');
    }
    
    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function ratingsReceived() {
        return $this->hasMany(Rating::class, 'rated_user_id');
    }
    
    public function ratingsGiven() {
        return $this->hasMany(Rating::class, 'rater_user_id');
    }
    public function sentMessages()
    {
    return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'reciever_id');
    }
    public function paymentsSent()
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }
    
    public function paymentsReceived()
    {
        return $this->hasMany(Payment::class, 'receiver_id');
    }

}
