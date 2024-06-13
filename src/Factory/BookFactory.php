<?php

namespace App\Factory;

use App\Entity\Book;
use App\Enum\BookStatus;
use App\Repository\BookRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @extends ModelFactory<Book>
 *
 * @method        Book|Proxy                     create(array|callable $attributes = [])
 * @method static Book|Proxy                     createOne(array $attributes = [])
 * @method static Book|Proxy                     find(object|array|mixed $criteria)
 * @method static Book|Proxy                     findOrCreate(array $attributes)
 * @method static Book|Proxy                     first(string $sortedField = 'id')
 * @method static Book|Proxy                     last(string $sortedField = 'id')
 * @method static Book|Proxy                     random(array $attributes = [])
 * @method static Book|Proxy                     randomOrCreate(array $attributes = [])
 * @method static BookRepository|RepositoryProxy repository()
 * @method static Book[]|Proxy[]                 all()
 * @method static Book[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Book[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Book[]|Proxy[]                 findBy(array $attributes)
 * @method static Book[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Book[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class BookFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'cover' => $this->createCoverFile(),
            'editedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'isbn' => self::faker()->isbn13(),
            'pageNumber' => self::faker()->randomNumber(),
            'plot' => self::faker()->text(),
            'status' => self::faker()->randomElement(BookStatus::cases()),
            'title' => self::faker()->unique()->sentence(),
            'editor' => EditorFactory::random(),
            'authors' => AuthorFactory::randomSet(self::faker()->numberBetween(1, 2)),
            'createdBy' => UserFactory::random(),
        ];
    }

    protected function createCoverFile(): string
    {
        $coverPath = __DIR__ . '/../../public/uploads/covers/';
        if (!file_exists($coverPath)) {
            mkdir($coverPath, 0777, true);
        }
        $coverFilename = sprintf('%s.jpg', uniqid());
        copy(__DIR__ . '/../../assets/sample-cover.jpg', $coverPath . $coverFilename);
        return $coverFilename;
    }

    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Book $book): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Book::class;
    }
}