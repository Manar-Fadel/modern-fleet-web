<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $mobile
 * @property string|null $message
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactUsForm withoutTrashed()
 * @mixin \Eloquent
 */
class ContactUsForm extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "contact_us_form";

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'user_id',
        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
