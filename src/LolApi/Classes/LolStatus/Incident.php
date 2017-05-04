<?php

namespace LolApi\Classes\LolStatus;

/**
 * Incident
 *
 * @author Javier
 */
class Incident {

    /**
     * 
     * @var boolean
     */
    public $active;

    /**
     * 
     * @var string
     */
    public $created_at;

    /**
     * 
     * @var long
     */
    public $id;

    /**
     * 
     * @var Message array List[Message]
     */
    public $updates;

    public function __construct($d) {
        $this->active = $d->active;
        $this->created_at = $d->created_at;
        $this->id = $d->id;
        $this->updates = [];
        foreach ($d->updates as $o) {
            $this->updates[] = new Message($o);
        }
    }

}
