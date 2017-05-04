<?php

namespace LolApi\Classes\LolStatus;
/**
 * Message
 *
 * @author Javier
 */
class Message {
    
    
    /**
     * @var string
     */
    public $author;
    
    /**
     * @var string
     */
    public $content;
    
    /**
     * @var string
     */
    public $created_at;
    
    /**
     * @var string
     */
    public $id;
    
    /**
     * @var string
     */
    public $severity;
    
    /**
     * @var List[Translation]
     */
    public $translations;
    
    /**
     * @var string
     */
    public $updated_at;
    
    public function __construct($d) {
        $this->author = $d->author;
        $this->content = $d->content;
        $this->created_at = $d->created_at;
        $this->id = $d->id;
        $this->severity = $d->severity;
        $this->translations = [];
        foreach ($d->translations as $o) {
            $this->translations[] = new Translation($o);
        }
        $this->updated_at = $d->updated_at;
    }

    
}
