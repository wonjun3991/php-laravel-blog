<?php

namespace App\Models;

use Database\Factories\CommentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $post_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static CommentFactory factory(...$parameters)
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereContent($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment wherePostId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @mixin Builder|Eloquent
 * @property-read \App\Models\Post $posts
 * @property-read \App\Models\Post $post
 * @method static Builder|Comment whereUsersId($value)
 * @property int $user_id
 * @method static Builder|Comment whereUserId($value)
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'content',
        'user_id'
    ];

    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
