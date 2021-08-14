<?php

use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name'=>'News'
        ]);

        $category2 = Category::create([
            'name'=>'Partnership'
        ]);

        $category3 = Category::create([
            'name'=>'Updates'
        ]);

        $author1 =User::create([
            'name'=>'Rajat',
            'email'=>'rajatdhiman088@gmail.com',
            'password'=>Hash::make('12345678')
        ]);

        $author2=User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('12345678')
        ]);

        $post1 = $author1->post()->create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'content'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'category_id'=> $category1->id,
            'image'=>'posts/1.jpg'
        ]);

        $post2 = $author2->post()->create([
            'title'=>'New published books to read by a product designer',
            'description'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'content'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'category_id'=> $category2->id,
            'image'=>'posts/2.jpg'
        ]);

        $post3 = $author1->post()->create([
            'title'=>'Congratulate and thank to Maryam for joining our team',
            'description'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'content'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'category_id'=> $category3->id,
            'image'=>'posts/3.jpg'
        ]);

        $post4 = $author2->post()->create([
            'title'=>'This is why its time to ditch dress codes at work',
            'description'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'content'=>'Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC',
            'category_id'=> $category1->id,
            'image'=>'posts/4.jpg'
        ]);

        $tag1=Tag::create([
            'name'=>'Hirring'
        ]);
        
        $tag2=Tag::create([
            'name'=>'Products'
        ]);

        $tag3=Tag::create([
            'name'=>'Customers'
        ]);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag1->id,$tag3->id]);
        $post4->tags()->attach([$tag3->id,$tag2->id]);

    }
}
