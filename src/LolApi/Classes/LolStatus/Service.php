<?php

namespace LolApi\Classes\LolStatus;

/**
 * Service
 *
 * @author Javier
 */
class Service {
    
    /**
     * 
     * @var Incident array List[Incident]
     */
    public $incidents;
    /**
     * 
     * @var string
     */
    public $name;
    /**
     * 
     * @var string
     */
    public $slug;
    /**
     * 
     * @var string
     */
    public $status;
    
    public function __construct($d) {
        $this->incidents = [];
        foreach ($d->incidents as $o) {
            $this->incidents[] = new Incident($o);
        }
        $this->name = $d->name;
        $this->slug = $d->slug;
        $this->status = $d->status;
    }

}
