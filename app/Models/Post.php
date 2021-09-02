<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @method static PostFactory factory(...$parameters)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @mixin Builder|\Eloquent
 * @property int $id
 * @property string $title
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @method static Builder|Post whereUsersId($value)
 * @property int $user_id
 * @method static Builder|Post whereUserId($value)
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
