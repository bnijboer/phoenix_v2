<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\SubscribedEmail
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscribedEmail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubscribedEmail extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
    ];

    public function subscriptions(): MorphMany
    {
        return $this->morphMany(Subscription::class, 'subscribable');
    }
}
