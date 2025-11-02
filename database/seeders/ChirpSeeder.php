<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chirp;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample data if they dont exist 

        //Sample users
        $users = User::count() < 3
            ? collect([
                User::create([
                    'name' => "Alice Developer",
                    'email' => "alice@example.com",
                    'password' => bcrypt("password"),
                ]),
                User::create([
                    'name' => "Bob The Builder",
                    'email' => "bob@example.com",
                    'password' => bcrypt("password"),
                ]),
                User::create([
                    'name' => "Willie The Hacker",
                    'email' => "william@example.com",
                    'password' => bcrypt("password"),
                ]),
            ]) : User::take(3)->get();

        // Sample chirps
        $chirps = [
            'The purpose of a storyteller is not to tell you how to think, but to give you questions to think upon.',
            'Life before Death. Strength before Weakness. Journey before Destination.',
            'You should try not to talk so much, friend. You will sound far less stupid that way',
            'Honor is dead. But I will see what I can do.',
            'And so, does the destination matter? Or is it the path we take? I declare that no accomplishment has substance nearly as great as the road used to achieve it. We are not creatures of destinations. It is the journey that shapes us. Our callused feet, our backs strong from carrying the weight of our travels, our eyes open with the fresh delight of experiences lived.',
            'But you can not kill me, Lord Tyrant. I represent that one thing you have never been able to kill, no matter how hard you try. I am hope.',
            'Its easy to believe in something when you win all the time...The losses are what define a mans faith',
        ];

        // Create chirps for random users

        foreach ($chirps as $message) {

            $users->random()->chirps()->create([
                'message' => $message,
                'created_at'=> now()->subMinutes(rand(5,1440)),
            ]);
        }
    }
}
