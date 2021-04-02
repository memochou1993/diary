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
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Resource $subject */
        $subject = Resource::factory()->make([
            'name' => '我',
        ]);
        $user->resources()->save($subject);

        /** @var Predicate $predicate */
        $predicate = Predicate::factory()->make([
            'name' => '養了',
        ]);
        $user->predicates()->save($predicate);

        /** @var Resource $object */
        $object = Resource::factory()->make([
            'name' => '狗',
        ]);
        $user->resources()->save($object);

        $statement = Statement::factory()->make([
            'subject_id' => $subject->id,
            'object_id' => $object->id,
            'predicate_id' => $predicate->id,
        ]);
        $user->statements()->save($statement);

        /** @var Resource $subject */
        $subject = Resource::factory()->make([
            'name' => '他',
        ]);
        $user->resources()->save($subject);

        /** @var Predicate $predicate */
        $predicate = Predicate::factory()->make([
            'name' => '買了',
        ]);
        $user->predicates()->save($predicate);

        /** @var Resource $object */
        $object = Resource::factory()->make([
            'name' => '電腦',
        ]);
        $user->resources()->save($object);

        $statement = Statement::factory()->make([
            'subject_id' => $subject->id,
            'object_id' => $object->id,
            'predicate_id' => $predicate->id,
        ]);
        $user->statements()->save($statement);
    }
}
