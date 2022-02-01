<?php


namespace App\Facades;

use App\Support\FootNoteManager;
use Illuminate\Support\Facades\Facade;

/**
 * Class FootNote
 * @package App\Facades
 *
 * @method static array addFootNote(int $id)
 * @method static array getFootNotes()
 */
class FootNote extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FootNoteManager::class;
    }
}
