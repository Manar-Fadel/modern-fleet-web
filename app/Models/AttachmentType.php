<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentType extends Model
{
    use SoftDeletes;

    protected $table = 'attachment_types';
    protected $fillable = [
        'name_en',
        'name_ar',
        'icon'
    ];
    protected $appends = ['icon_url', 'name'];


    protected function getNameAttribute(): ?string
    {
        $locale = app()->getLocale();
        return  ($locale == 'en') ? $this->name_en : $this->name_ar;
    }
    public function requestItems(): HasMany
    {
        return $this->hasMany(CarRequestItem::class, 'attachment_type_id');
    }

    public function getIconUrlAttribute(): string
    {
        if (!empty($this->attributes['icon'])) {
            return asset('storage/' . $this->attributes['icon']);
        }

        // اختياري: أيقونة افتراضية
        return asset('assets/web/images/attachment-icon.png');
    }
}
