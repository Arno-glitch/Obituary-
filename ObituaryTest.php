<?php

namespace Tests\Feature;

use App\Models\Obituary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ObituaryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_submission_form_loads(): void
    {
        $this->get(route('obituaries.create'))
            ->assertOk()
            ->assertSee('Submit an Obituary');
    }

    /** @test */
    public function a_valid_obituary_can_be_submitted_and_is_stored(): void
    {
        $payload = [
            'name' => 'Jane Doe',
            'date_of_birth' => '1950-01-01',
            'date_of_death' => '2024-05-10',
            'content' => 'Jane Doe was a beloved mother, teacher, and friend to many.',
            'author' => 'John Doe',
        ];

        $response = $this->post(route('obituaries.store'), $payload);

        $this->assertDatabaseHas('obituaries', ['name' => 'Jane Doe', 'author' => 'John Doe']);

        $obituary = Obituary::firstWhere('name', 'Jane Doe');
        $response->assertRedirect(route('obituaries.show', $obituary->slug));
    }

    /** @test */
    public function submission_fails_validation_when_required_fields_are_missing(): void
    {
        $response = $this->post(route('obituaries.store'), []);

        $response->assertSessionHasErrors(['name', 'date_of_birth', 'date_of_death', 'content', 'author']);
        $this->assertDatabaseCount('obituaries', 0);
    }

    /** @test */
    public function submission_fails_when_date_of_death_is_before_date_of_birth(): void
    {
        $response = $this->post(route('obituaries.store'), [
            'name' => 'Edge Case',
            'date_of_birth' => '2000-01-01',
            'date_of_death' => '1999-01-01',
            'content' => 'This should fail because the dates are reversed intentionally.',
            'author' => 'Tester',
        ]);

        $response->assertSessionHasErrors('date_of_death');
    }

    /** @test */
    public function the_index_page_lists_and_paginates_obituaries(): void
    {
        Obituary::factory()->count(15)->create();

        $response = $this->get(route('obituaries.index'));

        $response->assertOk();
        $response->assertViewHas('obituaries', function ($obituaries) {
            return $obituaries->count() === 10; // default per-page
        });
    }

    /** @test */
    public function a_single_obituary_page_shows_seo_and_og_tags(): void
    {
        $obituary = Obituary::factory()->create(['name' => 'Robert Smith']);

        $response = $this->get(route('obituaries.show', $obituary->slug));

        $response->assertOk();
        $response->assertSee('Robert Smith');
        $response->assertSee('og:title', false);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('rel="canonical"', false);
    }

    /** @test */
    public function the_sitemap_includes_every_obituary(): void
    {
        Obituary::factory()->count(3)->create();

        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }
}
