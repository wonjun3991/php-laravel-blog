# Laravel로 간단하게 블로그 만들기1
라라벨을 처음 시작하는 분들을 위해 [레일즈로 블로그 만들기](https://guides.rubyonrails.org/getting_started.html) 와 같은 느낌으로 만든 프로젝트입니다. 부족하지만 라라벨이 어려운 분들에게 도움이 되었으면 좋겠습니다.
## 참고자료
- [라라벨 8.x 공식문서](https://laravel.kr/docs/8.x)
- [PSR-12 : Extended Coding Style](https://www.php-fig.org/psr/psr-12/)
- [Laravel Style Guidelines - Spatie](https://spatie.be/guidelines/laravel-php) 

## 환경
- php7.4
- composer
## 설치
```bash
cp .env.example .env
touch database/database.sqlite
composer install
```
## 실행
```bash
php artisan serve
```
## 테스트
```bash
php artisan test
```
