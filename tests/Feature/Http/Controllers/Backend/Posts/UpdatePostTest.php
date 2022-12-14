<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Backend\Posts;

use App\Models\Post;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    public function testUserCanUpdatePost(): void
    {
        $post = Post::factory()->create([
            'title' => 'Old title',
            'content' => 'Lorem ipsum',
        ]);

        $this->actingAs($post->user)
            ->put(route('backend.posts.update', $post), [
                'title' => 'New title',
                'content' => 'Ipsum lorem',
            ])
            ->assertStatus(302)
            ->assertRedirect(route('backend.posts.edit', $post));

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'New title',
            'content' => 'Ipsum lorem',
        ]);

        $this->actingAs($post->user)
            ->get(route('backend.posts.edit', $post))
            ->assertSee(__('Edit Post'))
            ->assertSee(__('New title'))
            ->assertSee(__('Ipsum lorem'));
    }
}
