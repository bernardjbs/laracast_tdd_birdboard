<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Project;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function a_user_can_create_a_project()
  {
    $this->withoutExceptionHandling();

    // Set the attributes title and description for a project
    $attributes = [
      'title' => fake()->sentence(),
      'description' => fake()->paragraph()
    ];

    // Send a post request to the /projects endpoint to create a project, then assert that we are redirected to /projects endpoint
    $this->post('/projects', $attributes)->assertRedirect('/projects');

    // Assert that the attributes for the project was saved in the database in the projects table 
    $this->assertDatabaseHas('projects', $attributes);

    // Send a get request to the /projects endpoint and assert we can see the title attribute data
    $this->get('/projects')
      ->assertSee($attributes['title']);
  }

  /** @test */
  public function a_project_requires_a_title()
  {
    // Create an empty title and store it in an array
    $title = Project::factory()->raw(['title' => '']);
    $this->post('/projects', $title)->assertSessionHasErrors('title');
  }

  /** @test */
  public function a_project_requires_a_description()
  {
    // Create an empty description and store it in an array
    $description = Project::factory()->raw(['description' => '']);
    $this->post('/projects', $description)->assertSessionHasErrors('description');
  }

  /** @test */
  public function a_user_can_view_a_project() {
    $this->withoutExceptionHandling();

    $project = Project::factory()->create();
    // dd($project->id);
    $this->get('/projects/' . $project->id)
      ->assertSee($project->title)
      ->assertsee($project->description);
  }
}
