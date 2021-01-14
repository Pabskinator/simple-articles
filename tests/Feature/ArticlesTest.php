<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_displays_all_the_articles()
    {
        $this->withoutExceptionHandling();

        //generate articles
        Article::factory()->count(10)->create();

        //get all articles
        $response = $this->get(route('articles.index'));

        $this->assertCount(10, $response['articles']);
    }

    /** @test */
    public function it_displays_a_single_article()
    {
        $this->withoutExceptionHandling();

        $article = $this->createArticle();

        $response = $this->get('/api/articles/' . $article->id);

        $this->assertEquals($article->body, $response['article']['body']);
        $this->assertEquals($article->title, $response['article']['title']);
        $this->assertEquals($article->excerpt, $response['article']['excerpt']);

        $response->assertSeeText($article->title);
    }

    /** @test */
    public function it_allows_the_user_to_create_an_article()
    {
        $this->withoutExceptionHandling();

        //create a user
        $user = $this->createUser();

        //make a post request to a route to create an article
        $this->actingAs($user)->post('/api/articles', $this->postSampleArticle());

        //make sure that the article is added on the database
        $article = Article::first();

        $this->assertEquals(1, Article::count());
        $this->assertEquals('Sample', $article->title);
        $this->assertEquals('Subtitle', $article->excerpt);
        $this->assertEquals('Description', $article->body);
        $this->assertEquals($user->id, $article->user_id);
    }

    /** @test */
    public function it_validates_if_the_user_is_authenticated_before_it_creates_an_article()
    {
        $this->withHeaders($this->requestHeaders())
        ->post('/api/articles', $this->postSampleArticle())
        ->assertStatus(401);
    }

    /** @test */
    public function it_allows_the_user_to_get_the_editable_data_of_an_article()
    {
        $user = $this->createUser();

        $article = $this->createUserArticle($user);

        $response = $this->withHeaders($this->requestHeaders())
            ->actingAs($user)
            ->get('/api/articles/' . $article->id . '/edit');

        $response_array = $response->getData(true)['data'];

        $this->assertEquals($article->body, $response_array['body']);
        $this->assertEquals($article->title, $response_array['title']);
        $this->assertEquals($article->excerpt, $response_array['excerpt']);

        $response->assertSeeText($article->title);
    }

    /** @test */
    public function it_validates_if_the_user_is_authenticated_before_it_shows_the_editable_data()
    {

        $article = $this->createArticle();

        $this->withHeaders($this->requestHeaders())
            ->get('/api/articles/' . $article->id . '/edit')
            ->assertStatus(401);
    }

    /** @test */
    public function it_validates_if_the_user_is_the_author_of_the_article_before_showing_the_editable_data()
    {
        $response_array = $this->createResponseArray();

        $this->assertTrue($response_array['can']['update']);
    }

    /** @test */
    public function it_successfully_updates_the_data_of_the_edited_article()
    {
        $this->withoutExceptionHandling();

        //create a user
        $user = $this->createUser();

        //make a post request to a route to create an article
        $this->actingAs($user)->post('/api/articles', $this->postSampleArticle());

        $article = Article::first();

        //make a put request to a route to update the article
        $this->actingAs($user)->put('/api/articles/' . $article->id, [
            'title' => 'Sample Update',
            'excerpt' => 'Subtitle Update',
            'body' => 'Description Update'
        ]);

        $updated_article = Article::first();

        $this->assertEquals('Sample Update', $updated_article->title);
        $this->assertEquals('Subtitle Update', $updated_article->excerpt);
        $this->assertEquals('Description Update', $updated_article->body);
    }

    /** @test */
    public function it_validates_if_the_user_can_delete_the_article()
    {
        $response_array = $this->createResponseArray();

        $this->assertTrue($response_array['can']['delete']);
    }

    /** @test */
    public function it_successfully_destroys_an_article()
    {
        $user = $this->createUser();

        $article = $this->createUserArticle($user);

        $this->withHeaders($this->requestHeaders())
            ->actingAs($user)
            ->delete('/api/articles/' . $article->id);

        $articles = Article::all();

        $this->assertCount(0, $articles);
    }

    /** @test */
    public function it_throws_an_error_if_title_is_missing()
    {
        $user = $this->createUser();

        $this->withHeaders($this->requestHeaders())
            ->actingAs($user)
            ->post('/api/articles')
            ->assertStatus(422)
            ->assertJsonStructure(['errors' => ['title']]);
    }

    /** @test */
    public function it_throws_an_error_if_excerpt_is_missing()
    {
        $user = $this->createUser();

        $this->withHeaders($this->requestHeaders())
            ->actingAs($user)
            ->post('/api/articles')
            ->assertStatus(422)
            ->assertJsonStructure(['errors' => ['excerpt']]);
    }

    /** @test */
    public function it_throws_an_error_if_body_is_missing()
    {
        $user = $this->createUser();

        $this->withHeaders($this->requestHeaders())
            ->actingAs($user)
            ->post('/api/articles')
            ->assertStatus(422)
            ->assertJsonStructure(['errors' => ['body']]);
    }

    protected function createArticle(){

        return Article::factory()->create();

    }

    protected function postSampleArticle() : array
    {
        return [
            'title' => 'Sample',
            'excerpt' => 'Subtitle',
            'body' => 'Description'
        ];
    }

    protected function requestHeaders() : array
    {
        return [
            'X-Requested-With' => 'XMLHttpRequest',
            'accept' => 'application/json'
        ];
    }

    protected function createUser()
    {
        return User::factory()->create();
    }

    protected function createUserArticle($user)
    {
        $this->actingAs($user)->post('/api/articles', $this->postSampleArticle());

        return Article::first();
    }

    protected function createResponseArray(){
        $user = $this->createUser();

        $article = $this->createUserArticle($user);

        $response = $this->withHeaders($this->requestHeaders())
            ->actingAs($user)
            ->get('/api/articles/' . $article->id . '/edit');

        return $response->getData(true)['data'];
    }
}
