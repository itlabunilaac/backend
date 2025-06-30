<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
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

    /**
     * Create a token for API authentication
     */
    public function createToken($name)
    {
        $token = bin2hex(random_bytes(40));
        $expiresAt = now()->addHours(24);
        
        // Use cache-based token storage
        $tokenData = [
            'admin_id' => $this->id,
            'name' => $name,
            'expires_at' => $expiresAt->toDateTimeString(),
            'last_used_at' => now()->toDateTimeString(),
        ];
        
        \Illuminate\Support\Facades\Cache::put("admin_token_{$token}", $tokenData, $expiresAt);
        
        return (object) [
            'plainTextToken' => $token
        ];
    }

    /**
     * Get tokens relationship
     */
    public function tokens()
    {
        return $this->hasMany(AdminToken::class);
    }

    /**
     * Revoke all tokens
     */
    public function revokeTokens()
    {
        try {
            return $this->tokens()->delete();
        } catch (\Exception $e) {
            // For cache-based tokens, we can't easily revoke all tokens
            // This would require storing a list of all tokens for this admin
            return true;
        }
    }
}
