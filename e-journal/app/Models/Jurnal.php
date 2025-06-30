<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurnal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'foto',
        'deskripsi',
        'akreditasi',
        'link_akreditasi',
        'subject',
        'penerbit',
        'link_penerbit',
        'judul',
        'views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'views' => 'integer',
        ];
    }

    /**
     * Scope a query to search for journals.
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('deskripsi', 'like', "%{$keyword}%")
              ->orWhere('subject', 'like', "%{$keyword}%")
              ->orWhere('penerbit', 'like', "%{$keyword}%");
        });
    }

    /**
     * Scope a query to filter by subject.
     */
    public function scopeSubject($query, $subject)
    {
        return $query->where('subject', $subject);
    }

    /**
     * Scope a query to filter by akreditasi.
     */
    public function scopeAkreditasi($query, $akreditasi)
    {
        return $query->where('akreditasi', $akreditasi);
    }

    /**
     * Increment views count.
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
