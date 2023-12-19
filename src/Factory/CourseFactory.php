<?php

namespace App\Factory;

use App\Entity\Course;
use App\Repository\CourseRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Course>
 *
 * @method        Course|Proxy                     create(array|callable $attributes = [])
 * @method static Course|Proxy                     createOne(array $attributes = [])
 * @method static Course|Proxy                     find(object|array|mixed $criteria)
 * @method static Course|Proxy                     findOrCreate(array $attributes)
 * @method static Course|Proxy                     first(string $sortedField = 'id')
 * @method static Course|Proxy                     last(string $sortedField = 'id')
 * @method static Course|Proxy                     random(array $attributes = [])
 * @method static Course|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CourseRepository|RepositoryProxy repository()
 * @method static Course[]|Proxy[]                 all()
 * @method static Course[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Course[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Course[]|Proxy[]                 findBy(array $attributes)
 * @method static Course[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Course[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CourseFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'category' => CategoryFactory::random(),
            'title' => self::faker()->text(50),
            'createdAt' => self::faker()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Course $course): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Course::class;
    }
}
