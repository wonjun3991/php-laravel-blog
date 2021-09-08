<?php /** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\PostsController
 */
class PostTest extends TestCase
{
    /**
     * @test
     * @covers ::store
     */
    public function 포스트_등록_성공()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $post = Post::factory()->make();

        $this->post(route('posts.store'), [
            'title' => $post->title,
            'content' => $post->content
        ])->assertRedirect();

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'content' => $post->content
        ]);
    }
}
