<?php

namespace LolApi\Classes\Summoner;

/**
 * RunePageDto
 *
 * @author Javier
 */
class RunePageDto {

    /**
     * Indicates if the page is the current page.
     * @var boolean
     */
    public $current;

    /**
     * Rune page ID.
     * @var long
     */
    public $id;

    /**
     * Rune page name.
     * @var string
     */
    public $name;

    /**
     * Collection of rune slots associated with the rune page.
     * @var RuneSlotDto array Set[RuneSlotDto]
     */
    public $slots;

    public function __construct($d) {
        $this->current = $d->current;
        $this->id = $d->id;
        $this->name = $d->name;
        $this->slots = [];
        foreach ($d->slots as $key => $o) {
            $this->slots[$key] = new RuneSlotDto($o);
        }
    }

}
