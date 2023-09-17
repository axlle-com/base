<?php

namespace App\Models\User;

use App\Models\History\History;
use App\Models\Logger;
use App\Models\TelegramUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic
 * @property string|null $phone
 * @property string|null $email
 * @property bool|null $is_email
 * @property bool|null $is_phone
 * @property int $status
 * @property string|null $avatar
 * @property string $password_hash
 * @property string|null $remember_token
 * @property string|null $auth_key
 * @property string|null $password_reset_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|History[] $histories
 * @property Collection|Logger[] $loggers
 * @property Collection|TelegramUser[] $telegram_users
 * @property Collection|UserToken[] $user_tokens
 *
 * @package App\Models
 */
class User extends BaseUser
{
    public ?string $ip = null;

    protected $table = 'user';

    protected $casts = [
        'is_email' => 'bool',
        'is_phone' => 'bool',
        'status' => 'int'
    ];

    protected $hidden = [
        'remember_token',
        'password_reset_token'
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'email',
        'is_email',
        'is_phone',
        'status',
        'avatar',
        'password_hash',
        'remember_token',
        'auth_key',
        'password_reset_token'
    ];

    private static array $instances = [];

    /**
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return HasMany
     */
    public function loggers(): HasMany
    {
        return $this->hasMany(Logger::class);
    }

    /**
     * @return HasMany
     */
    public function telegramUsers(): HasMany
    {
        return $this->hasMany(TelegramUser::class);
    }

    /**
     * @return HasMany
     */
    public function userTokens(): HasMany
    {
        return $this->hasMany(UserToken::class);
    }

    public static function auth()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            if (__CLASS__ === $subclass) {
                /** @var User $user */
                if ($user = Auth::user()) {
                    $user->ip = $_SERVER['REMOTE_ADDR'];
                    if (!$user->getSessionRoles()) {
                        $user->setSessionRoles();
                    }
                    if (!$user->getSessionPermissions()) {
                        $user->setSessionPermissions();
                    }
                }
            }
            self::$instances[$subclass] = $user ?? null;
        }
        return self::$instances[$subclass];
    }

    public function getSessionRoles(): array
    {
        $user = session('_user', []);
        return $user['roles'] ?? [];
    }

    public function setSessionRoles(): void
    {
        $user = session('_user', []);
        $user['roles'] = $this->getRoleNames()->toArray();
        session(['_user' => $user]);
    }

    public function getSessionPermissions(): array
    {
        $user = session('_user', []);
        return $user['permissions'] ?? [];
    }

    public function setSessionPermissions(): void
    {
        $user = session('_user', []);
        $user['permissions'] = $this->getAllPermissions()->pluck('name')->toArray();
        session(['_user' => $user]);
    }
}
