<?php /** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;


/**
 * @coversDefaultClass \App\Http\Controllers\AuthController
 */
class UserTest extends TestCase
{
    /**
     * @test
     * @testdox UserFactory 에서 생성하는 유저는 'password' 를 해쉬화 한 값을 갖고있다.
     * @covers ::login
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
     * @covers ::login
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
     * @covers ::register
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
     * @testdox 중복된 이메일은 회원가입시 validation 오류 발생
     * @covers ::register
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
        $response->assertInvalid(['email']);
    }

    /**
     * @test
     * @dataProvider 올바르지_않은_이메일_공급자
     */
    public function 로그인_올바르지_않은_이메일($email)
    {
        $this->post(route('auth.login'),
            [
                'email' => $email,
                'password' => 'password',
            ])->assertValid('password')
            ->assertInvalid('email');
    }

    public function 올바르지_않은_이메일_공급자(): array
    {
        return [
            ['2131naver.com'],
            ['12321@'],
            ['321213'],
        ];
    }
}
