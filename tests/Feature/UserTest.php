<?php /** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function 로그인_성공()
    {
        $user = User::factory()->create();

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(route('posts.index'));
    }

    /**
     * @test
     */
    public function 로그인_실패()
    {
        $user = User::factory()->create();

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'exampleTest'
        ]);

        $response->assertRedirect();
    }

    /**
     * @test
     * @testdox UserFactory 에서 생성하는 유저는 'password' 를 해쉬화 한 값을 갖고있다.
     */
    public function 회원가입_후_유저생성_확인()
    {
        $user = User::factory()->make();

        $this->post(route('auth.register'),
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'password',
            ]
        )->assertRedirect(route('auth.login'));

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }

    /**
     * @test
     * @testdox 중복된 이메일은 회원가입시 오류 발생
     */
    public function 회원가입_중복된_이메일()
    {
        $user = User::factory()->create();

        $response = $this->post(route('auth.register'),
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'password',
            ]
        );
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
