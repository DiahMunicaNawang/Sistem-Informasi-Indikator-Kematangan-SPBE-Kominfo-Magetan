<?php

namespace Tests\Feature\Services\ManajemenPengetahuan\Artikel;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article\Article;
use App\Models\ArticleRating;
use App\Models\ArticleCategory;
use App\Models\ArticleValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\Article\ArticleService;
use App\Mail\ArticleValidationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected $articleService;
    protected $user;
    protected $role;
    protected $author;
    protected $categoryId;
    protected $validatorRole;
    protected $articles;

    protected function setUp(): void
    {
        parent::setUp();

        $this->articleService = $this->app->make(ArticleService::class); // Menggunakan service container untuk membuat instance

        // Buat role terlebih dahulu
        $this->role = \App\Models\Role::create([
            'name' => 'Admin',
        ]);

        // Persiapkan role yang valid
        $roleId = $this->role->id;  // Ambil ID dari objek role

        // Persiapan data dummy di database
        $this->user = DB::table('users')->insertGetId([
            'email' => 'dummyuser@example.com',
            'username' => 'dummyuser',
            'password' => bcrypt('password'),
            'role_id' => $this->role->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ambil user berdasarkan ID yang baru dimasukkan
        $user = \App\Models\User::find($this->user);

        $this->actingAs($user);

        // Buat author dengan role ID yang valid dan simpan di $this->author
        $this->author = User::create([
            'email' => 'author@example.com',
            'username' => 'authoruser',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => null,
            'role_id' => $roleId,  // Gunakan ID numerik untuk role_id
        ]);

        // Persiapan data dummy untuk kategori
        $this->categoryId = DB::table('article_categories')->insertGetId([
            'category_name' => 'Technology',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat role kedua untuk validator, jika role dengan ID 2 tidak ada
        $this->validatorRole = \App\Models\Role::create([
            'name' => 'Validator',
        ]);

        $this->articles = DB::table('articles')->insertGetId([
            'title' => 'the title',
            'article_summary' => 'the article summary',
            'article_content' => 'the article content',
            'article_status' => 'the article status',
            'user_id' => $this->user,
            'validator_user_id' => $this->user,
            'created_at' => now(),
            'updated_at' => now(),
            'category_id' => $this->categoryId,
            'image' => 'omagad.png',
        ]);

        Mail::fake(); // Add this line
    }

    /** @test */
    public function test_get_categories()
    {
        // Memanggil method getCategories() dan memastikan hasilnya
        $categories = $this->articleService->getCategories();

        // Menguji apakah method mengembalikan kategori yang benar
        $this->assertCount(1, $categories); // Mengecek jumlah kategori yang dikembalikan
        $this->assertEquals('Technology', $categories[0]->category_name); // Memastikan kategori pertama adalah "Technology"
    }

    public function test_get_articles_with_filter()
    {
        // Insert articles with the user_id
        $articleId1 = DB::table('articles')->insertGetId([
            'title' => 'Test Article 1',
            'article_summary' => 'Summary for Test Article 1',
            'article_content' => 'Content for Test Article 1',
            'category_id' => $this->categoryId,
            'article_status' => 'published',
            'user_id' => $this->user, // user_id is linked
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        $articleId2 = DB::table('articles')->insertGetId([
            'title' => 'Another Test Article',
            'article_summary' => 'Summary for Another Test Article',
            'article_content' => 'Content for Another Test Article',
            'category_id' => $this->categoryId,
            'article_status' => 'published',
            'user_id' => $this->user, // user_id is linked
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        // Insert ratings for articles based on the new schema
        DB::table('article_ratings')->insert([
            'article_id' => $articleId1,  // Referencing the article being rated
            'rater_user_id' => $this->user,    // The user who is rating the article
            'rating_value' => 4,           // The rating value (e.g., 4 out of 5)
            'rating_date' => now(),        // The current timestamp as the rating date
            'created_at' => now(),         // For creation timestamp
            'updated_at' => now(),         // For updated timestamp (you may adjust based on your use case)
        ]);

        // Test without search filter
        $articles = $this->articleService->getArticles();

        $this->assertCount(2, $articles);
        $this->assertEquals('Test Article 1', $articles[0]->title);
        $this->assertEquals('Another Test Article', $articles[1]->title);

        // Test with title search filter
        $articles = $this->articleService->getArticles('Another');
        $this->assertCount(1, $articles);
        $this->assertEquals('Another Test Article', $articles[0]->title);
    }

    /** @test */
    public function test_create_article_successfully()
    {
        // Data yang akan digunakan untuk membuat artikel
        $data = [
            'judul' => 'Belajar Laravel',
            'ringkasan' => 'Artikel tentang dasar-dasar Laravel.',
            'konten' => 'Laravel adalah framework PHP yang sangat populer.',
            'kategori' => $this->categoryId,
            'image' => 'laravel.png',
            'article_status' => 'draft',
            'user_id' => $this->user,
        ];

        // Panggil service untuk membuat artikel
        $service = new \App\Services\Article\ArticleService();
        $article = $service->createArticle($data);

        // Pastikan artikel tersimpan di database
        $this->assertDatabaseHas('articles', [
            'title' => 'Belajar Laravel',
            'article_summary' => 'Artikel tentang dasar-dasar Laravel.',
            'article_content' => 'Laravel adalah framework PHP yang sangat populer.',
            'category_id' => $this->categoryId,
            'image' => 'laravel.png',
            'article_status' => 'draft',
            'user_id' => $this->user,
        ]);

        // Pastikan objek yang dikembalikan sesuai
        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals('Belajar Laravel', $article->title);
        $this->assertEquals('draft', $article->article_status);
    }


    public function test_create_article_without_image()
    {
        // Data yang akan digunakan untuk membuat artikel
        $data = [
            'judul' => 'Belajar Laravel',
            'ringkasan' => 'Artikel tentang dasar-dasar Laravel.',
            'konten' => 'Laravel adalah framework PHP yang sangat populer.',
            'kategori' => $this->categoryId,
            'user_id' => $this->user,
        ];

        // Panggil service untuk membuat artikel
        $service = new \App\Services\Article\ArticleService();
        $article = $service->createArticle($data);

        // Pastikan artikel tersimpan di database
        $this->assertDatabaseHas('articles', [
            'title' => 'Belajar Laravel',
            'article_summary' => 'Artikel tentang dasar-dasar Laravel.',
            'article_content' => 'Laravel adalah framework PHP yang sangat populer.',
            'category_id' => $this->categoryId,
            'user_id' => Auth::id(),
            'article_status' => 'draft',
        ]);

        // Pastikan objek yang dikembalikan sesuai
        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals('Belajar Laravel', $article->title);
        $this->assertEquals('draft', $article->article_status);
    }

    /** @test */
    public function test_store_rating()
    {
        // Buat artikel dengan category_id yang valid
        $article = Article::create([
            'title' => 'Article Title',
            'article_summary' => 'Summary of the Article',
            'article_content' => 'Article Content',
            'article_status' => 'published',
            'user_id' => $this->user,
            'category_id' => $this->categoryId, // Masukkan category_id
            'rater_user_id' => $this->user,
        ]);

        $data = [
            'article_id' => $this->articles,
            'rating' => 5,
            'review' => 'Excellent article!',
            'rater_user_id' => $this->user,
        ];

        $service = new \App\Services\Article\ArticleService();
        $service->storeRating($data);

        // Pastikan rating tersimpan di database
        $this->assertDatabaseHas('article_ratings', [
            'article_id' => $this->articles,
            'rater_user_id' => $this->user,
            'rating_value' => 5,
            'review' => 'Excellent article!',
        ]);
    }


    /** @test */
    public function test_store_validation_proses()
    {
        Mail::fake();

        // Simpan artikel
        $articleId = DB::table('articles')->insertGetId([
            'title' => 'Article Title',
            'article_summary' => 'Summary of the Article',
            'article_content' => 'Article Content',
            'article_status' => 'draft',
            'category_id' => $this->categoryId,
            'user_id' => $this->user,
            'image' => 'huhuh.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $data = [
            'validation_status' => 'proses',
            'comments' => 'Needs review.',
        ];

        // Set pengguna login
        $this->actingAs(User::find($this->user));

        // Panggil metode storeValidation
        $service = new \App\Services\Article\ArticleService();
        $service->storeValidation($articleId, $data);

        // Verifikasi data tersimpan di database
        $this->assertDatabaseHas('article_validations', [
            'article_id' => $articleId,
            'validator_user_id' => $this->user,
            'validation_status' => 'proses',
            'comments' => 'Needs review.',
        ]);

        $this->assertDatabaseHas('articles', [
            'id' => $articleId,
            'article_status' => 'in_review',
        ]);

        // Verifikasi email terkirim
        Mail::assertSent(ArticleValidationNotification::class, function ($mail) use ($data, $articleId) {
            $article = Article::find($articleId);
            return $mail->hasTo($article->user->email) &&
                $mail->title === $article->title &&
                $mail->status === $data['validation_status'] &&
                $mail->comments === $data['comments'];
        });
    }
}
