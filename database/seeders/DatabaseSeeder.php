<?php

namespace Database\Seeders;

use App\Models\Predicate;
use App\Models\Resource;
use App\Models\Statement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $admin */
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
        ]);

        /** @var Predicate $is */
        $is = $admin->predicates()->save(Predicate::factory()->make([
            'name' => '@is',
        ]));

        /** @var Resource $root */
        $root = $admin->resources()->save(Resource::factory()->make([
            'name' => '@root',
        ]));

        /** @var Resource $protected */
        $protected = $admin->resources()->save(Resource::factory()->make([
            'name' => '@protected',
        ]));

        /** @var User $user */
        $user = User::factory()->create();

        /** @var Resource $i */
        $i = Resource::factory()->make([
            'name' => '我',
        ]);
        $user->resources()->save($i);

        /** @var Predicate $have */
        $have = Predicate::factory()->make([
            'name' => '有',
        ]);
        $user->predicates()->save($have);

        /** @var Resource $note */
        $note = Resource::factory()->make([
            'name' => '日記',
        ]);
        $user->resources()->save($note);

        /** @var Statement $statement */
        $statement = Statement::factory()->make([
            'subject_id' => $i->id,
            'predicate_id' => $is->id,
            'object_id' => $root->id,
        ]);
        $user->statements()->save($statement);

        /** @var Statement $statement */
        $statement = Statement::factory()->make([
            'subject_id' => $i->id,
            'predicate_id' => $is->id,
            'object_id' => $protected->id,
        ]);
        $user->statements()->save($statement);

        /** @var Statement $statement */
        $statement = Statement::factory()->make([
            'subject_id' => $i->id,
            'predicate_id' => $have->id,
            'object_id' => $note->id,
        ]);
        $user->statements()->save($statement);

        $user->resource()->associate($i)->save();
    }
}
