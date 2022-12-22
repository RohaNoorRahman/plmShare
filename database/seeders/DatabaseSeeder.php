<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use App\Models\Platform;
use App\Models\Course;
use App\Models\Author;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $user = new User();
        // $user->name = 'Rohan Rahman';
        // $user->email = 'rohan@gmail.com';
        // $user->password =bcrypt('rohan222666');
        // $user->save();

        User::create([
            'name' => 'Admin',
            'email' => 'rohan@gmail.com',
            'password'=> bcrypt('password'),
            'type'=>1,
        ]);
        
        $series =[
            ['name' => 'Php','image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png','slug' => 'Php'],

            ['name' => 'laravel', 'image' => 'https://ih1.redbubble.net/image.1019780997.2134/flat,750x,075,f-pad,750x1000,f8f8f8.jpg','slug' => 'laravel'],
            ['name' => 'Wordpress' , 'image' =>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSB4KO9fIAijDApwVYFvSObmvutXsCbDecWDw&usqp=CAU','slug'=>'wordpress'],
            ['name' => 'View','image' => 'https://static.javatpoint.com/tutorial/vue-js/images/vue-js2.png','slug'=>'view'],
            ['name' => 'Javascript', 'image' =>'https://www.seekpng.com/png/full/958-9587147_javascript-logo-graphic-design.png','slug' => 'javascript']
        ];
        foreach($series as $item){
            Series::create([
                'name' => $item['name'],
                'image' => $item['image'],
                'slug' => $item['slug'],
            ]);
        }

        $topics = ['Eloquent','Validation','Refactoring','Athuntecation','Testing'];
        foreach($topics as $topic){

            $slug = strtolower(str_replace(' ','-',$topic));

            Topic::create([
                'name' => $topic,
                'slug' =>$slug,
            ]);
        }

        $platform = ['Laracast','You Tube','Larajobs','Laravel News','Laracasts Forum'];
        foreach($platform as $item){
            Platform::create([
                'name'=>$item,
            ]);
        }

        //fake 10 Author Create
        Author::factory(10)->create();

        //fake 50 User crate
        User::factory(50)->create();

        //fake 100 course create
        Course::factory(100)->create();

        $courses = Course::all();
        foreach($courses as $course){
            $topics = Topic::all()->random(rand(1,5))->pluck('id')->toArray();
            $course->topics()->attach($topics);

            $authors = Author::all()->random(rand(1,4))->pluck('id')->toArray();
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1,4))->pluck('id')->toArray();
            $course->series()->attach($series);
        }

        //fake review create
        Review::factory(100)->create();

    }
}
