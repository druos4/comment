<?php

namespace Tests\Feature;

use App\Comments;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function testsCommentIsCreatedCorrectly()
    {
        $loadData = ['parentId' => 0,
            'postId' => 123,
            'comment' => 'Some comment',
            'author' => 'John Doe'
        ];

        $this->json('POST', '/api/comments', $loadData)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'parentId' => 0, 'postId' => 123, 'comment' => 'Some comment', 'author' => 'John Doe']);
    }

    public function testsCommentIsUpdatedCorrectly()
    {
        $comment = factory(Comments::class)->create([
            'parentId' => 0,
            'postId' => 123,
            'comment' => 'Some comment',
            'author' => 'John Doe'
        ]);

        $loadData = [
            'comment' => 'Some new comment text',
        ];

        $response = $this->json('PUT', '/api/comments/' . $comment->id, $loadData)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'comment' => 'Some new comment text',
            ]);
    }

    public function testsCommentIsDeletedCorrectly()
    {
        $comment = factory(Comments::class)->create([
            'parentId' => 0,
            'postId' => 123,
            'comment' => 'Some comment',
            'author' => 'John Doe'
        ]);

        $this->json('DELETE', '/api/comments/' . $comment->id, [])
            ->assertStatus(204);
    }

    public function testCommentIsListedCorrectly()
    {
        factory(Comments::class)->create([
            'parentId' => 0,
            'postId' => 123,
            'comment' => 'Some comment',
            'author' => 'John Doe'
        ]);

        factory(Comments::class)->create([
            'parentId' => 0,
            'postId' => 123,
            'comment' => 'Some another comment',
            'author' => 'Secundus'
        ]);

        $response = $this->json('GET', '/api/comments', [])
            ->assertStatus(200)
            ->assertJson([
                [ 'parentId' => 0,
                    'postId' => 123,
                    'comment' => 'Some comment',
                    'author' => 'John Doe' ],
                [ 'parentId' => 0,
                    'postId' => 123,
                    'comment' => 'Some another comment',
                    'author' => 'Secundus' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'author', 'comment', 'created_at', 'updated_at'],
            ]);
    }
}
