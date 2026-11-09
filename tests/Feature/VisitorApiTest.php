<?php

namespace Tests\Feature;

use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;

class VisitorApiTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(PreventRequestForgery::class);
    }
    private array $payload = [
        'name' => 'Juan Dela Cruz',
        'address' => 'Tagudin, Ilocos Sur',
        'position' => 'Inspector',
    ];

    public function test_index_shows_visitors(): void
    {
        Visitor::factory()->create(['name' => 'Maria Santos']);

        $this->get('/visitors')
            ->assertOk()
            ->assertSee('Maria Santos');
    }

    public function test_index_can_search(): void
    {
        Visitor::factory()->create(['name' => 'Maria Santos']);
        Visitor::factory()->create(['name' => 'Pedro Reyes']);

        $this->get('/visitors?search=Maria')
            ->assertOk()
            ->assertSee('Maria Santos')
            ->assertDontSee('Pedro Reyes');
    }

    public function test_create_page_loads(): void
    {
        $this->get('/visitors/create')->assertOk()->assertSee('Add Visitor');
    }

    public function test_store_creates_visitor(): void
    {
        $this->post('/visitors', $this->payload)
            ->assertRedirect(route('visitors.index'));

        $this->assertDatabaseHas('visitors', $this->payload);
    }

    public function test_store_validates_input(): void
    {
        $this->post('/visitors', [])
            ->assertSessionHasErrors(['name', 'address', 'position']);
    }

    public function test_show_displays_visitor(): void
    {
        $visitor = Visitor::factory()->create();

        $this->get("/visitors/{$visitor->id}")
            ->assertOk()
            ->assertSee($visitor->name);
    }

    public function test_show_returns_404_when_missing(): void
    {
        $this->get('/visitors/999')->assertNotFound();
    }

    public function test_edit_page_loads(): void
    {
        $visitor = Visitor::factory()->create();

        $this->get("/visitors/{$visitor->id}/edit")
            ->assertOk()
            ->assertSee('Edit Visitor');
    }

    public function test_update_changes_visitor(): void
    {
        $visitor = Visitor::factory()->create();

        $this->put("/visitors/{$visitor->id}", $this->payload)
            ->assertRedirect(route('visitors.index'));

        $this->assertDatabaseHas('visitors', ['id' => $visitor->id] + $this->payload);
    }

    public function test_destroy_deletes_visitor(): void
    {
        $visitor = Visitor::factory()->create();

        $this->delete("/visitors/{$visitor->id}")
            ->assertRedirect(route('visitors.index'));

        $this->assertDatabaseMissing('visitors', ['id' => $visitor->id]);
    }
}