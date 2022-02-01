<?php


namespace App\Support;

use App\FootNote;

class FootNoteManager
{
    public $footNotes;

    public function __construct()
    {
        $this->footNotes = [];
    }

    public function addFootNote(int $id)
    {
        $this->footNotes[] = $id;

        return '<a href="#footer">' . count($this->footNotes) . '</a>';
    }

    public function getFootNotes(): array
    {
        $footNotes = [];
        foreach ($this->footNotes as $symbol => $footNoteId) {
            $footNotes[$symbol] = FootNote::find($footNoteId)->content;
        }

        return $footNotes;
    }
}
