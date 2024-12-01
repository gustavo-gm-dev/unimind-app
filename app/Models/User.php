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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'professor_id',
        'ativo',
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

    // Relacionamento recursivo: Usuário pertence a um professor
    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    // Relacionamento recursivo: Professor tem vários alunos
    public function alunos()
    {
        return $this->hasMany(User::class, 'professor_id');
    }

    const ROLE_ADMIN = 'role_admin';
    const ROLE_PROFESSOR = 'role_professor';
    const ROLE_ALUNO= 'role_aluno';

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isProfessor()
    {
        return $this->role === self::ROLE_PROFESSOR;
    }

    public function isAluno()
    {
        return $this->role === self::ROLE_ALUNO;
    }
}
