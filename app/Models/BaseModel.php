<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * This is the BaseModel class.
 *
 * @property int $id
 *
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 *
 */
abstract class BaseModel extends Model
{
    protected $dateFormat = 'U';
    protected $perPage = 30;
    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];
    protected bool $isNew = false;

    /**
     * @return void
     */
    protected static function boot(): void
    {
        self::creating(static function ($model) {});
        self::created(static function ($model) {});
        self::updating(static function ($model) {});
        self::updated(static function ($model) {});
        self::deleting(static function ($model) {});
        self::deleted(static function ($model) {});
        parent::boot();
    }

    public static function className(string $table = 'user'): ?string
    {
        $classes = File::allFiles(app_path('Models'));
        foreach ($classes as $class) {
            $classname = str_replace([app_path(), '/', '.php',], ['App', '\\', '',], $class->getRealPath());
            if (is_subclass_of($classname, Model::class)) {
                $model = new $classname;
                if ($table === $model->getTable()) {
                    return $model::class;
                }
            }
        }

        return null;
    }

    public function getTable(string $column = ''): string
    {
        return $this->table . $column ?? Str::snake(Str::pluralStudly(class_basename($this))) . $column;
    }

    public static function table(string $column = ''): string
    {
        $column = $column ? '.' . trim($column, '.') : '';

        return (new static())->getTable($column);
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            set: static fn($value) => strtotime($value),
        );
    }

    protected function deletedAt(): Attribute
    {
        return Attribute::make(
            set: static fn($value) => strtotime($value),
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value,
            set: static fn($value) => strtotime($value)
        );
    }

    public function getCreatedAtShot(): string
    {
        return date('d.m.y', $this->created_at);
    }
}