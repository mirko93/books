<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
        $this->post('/authors', $this->data());

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1993/13/11', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['name' => '']));
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_dob_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['dob' => '']));
        $response->assertSessionHasErrors('dob');
    }

    private function data()
    {
        return [
            'name' => 'Author Name',
            'dob' => '11/13/1993',
        ];
    }
}
