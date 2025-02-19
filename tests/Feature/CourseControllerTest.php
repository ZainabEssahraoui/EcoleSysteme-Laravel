<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $module;
    protected $group;
    protected $course;

    public function setUp(): void
    {
        parent::setUp();

    
        $this->group = Group::factory()->create();
        $this->user = User::factory()->create([
            'role' => 'student',
            'group_id' => $this->group->id,
        ]);
        $this->module = Module::factory()->create();
        $this->course = Course::factory()->create([
            'student_id' => $this->user->id,
            'module_id' => $this->module->id,
        ]);

        // auth User
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_can_list_courses()
    {
        $response = $this->get(route('courses.index'));

        $response->assertStatus(200)
                 ->assertViewHas('courses');
    }

/** @test */
public function it_can_create_a_course()
{
    Storage::fake('public'); // Simulation stockage

    // Générer un faux fichier PDF et l'enregistrer dans un chemin spécifique
    $file = UploadedFile::fake()->create('course_material.pdf', 150, 'application/pdf');

    // Préparer les données du cours avec le fichier
    $data = [
        'title' => 'Advanced Laravel',
        'description' => 'Deep dive into Laravel features',
        'module_id' => $this->module->id,
        'file' => $file, // Fichier simulé
    ];

    // Exécuter la requête POST pour créer un cours
    $response = $this->post(route('courses.store'), $data);

    // Vérifier que l'utilisateur est bien redirigé
    $response->assertRedirect(route('courses.index'));

    // Vérifier que la base de données contient bien le nouveau cours
    $this->assertDatabaseHas('courses', ['title' => 'Advanced Laravel']);

    // Vérifier que le fichier a bien été stocké dans 'public/uploads/'
    $fileName = time() . '_' . $file->getClientOriginalName(); // Get the correct file name
    $path = 'uploads/' . $fileName; // Correct file path

    // Check if the file exists in the fake storage
    Storage::disk('public')->assertExists($path);
}
 




    /** @test */
    public function it_can_show_a_course()
    {
        $response = $this->get(route('courses.show', $this->course->id));

        $response->assertStatus(200)
                 ->assertViewHas('course');
    }

    /** @test */
    public function it_can_update_a_course()
    {
        $response = $this->put(route('courses.update', $this->course->id), [
            'title' => 'Updated Course Title',
            'description' => 'Updated Description',
            'module_id' => $this->module->id,
        ]);

        $response->assertRedirect(route('courses.index'));
        $this->assertDatabaseHas('courses', ['title' => 'Updated Course Title']);
    }

    /** @test */
    public function it_can_delete_a_course()
    {
        $response = $this->delete(route('courses.destroy', $this->course->id));

        $response->assertRedirect(route('courses.index'));
        $this->assertDatabaseMissing('courses', ['id' => $this->course->id]);
    }
}
