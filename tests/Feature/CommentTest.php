<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\CommentsController
 */
class CommentTest extends TestCase
{
    /**
     * @test
     * @covers ::store
     */
    public function 존재하지_않는_포스트_404()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $comment = Comment::factory()->make([
            'post_id' => 1
        ]);

        $response = $this->post(route('posts.comments.store', ['post' => 1]), [
            'content' => $comment->content,
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     * @covers ::store
     */
    public function 코멘트_작성()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $comment = Comment::factory()->make();

        $response = $this->post(route('posts.comments.store', ['post' => $comment->post_id]), [
            'content' => $comment->content
        ]);

        $response->assertRedirect(route('posts.show', ['post' => $comment->post_id]));
        $this->assertDatabaseHas('comments', [
            'content' => $comment->content
        ]);
    }
}
