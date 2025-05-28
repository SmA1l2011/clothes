<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryController extends TestCase
{
    public function it_displays_categories_on_the_page() 
    {
        // Створисно пост у базі 
        $post1 = Category::factory()->create([
            'title' => 'Category', 
            'description' => 'Categoggogogogogogogo', 
        ]);

        // Викликаємо сторінку, де мають відображатися пости 
        $response = $this->get('/category'); // Це маршрут, де мають бути відображені пости 

        // Перевірясно, чи сторінка завантажується успішно 
        $response->assertStatus(200); 

        // Перевіряємо, чи на сторінці в пости 
        $response->assertSee($post1->title); // Перевірка, що заголовок поста е на сторінці 
        $response->assertSee($post1->description); // Перевірка, що контент поста в на сторінці 
    }
}
