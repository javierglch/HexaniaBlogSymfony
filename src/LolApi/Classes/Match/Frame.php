<?php

namespace LolApi\Classes\Match;

/**
 * Frame
 * This object contains game frame information
 * @author Javier
 */
class Frame {

    /**
     * List of events for this frame.
     * @var Event array List[Event] 
     */
    public $events;

    /**
     * Map of each participant ID to the participant's information for the frame.
     * @var ParticipantFrame array Map[string, ParticipantFrame]
     */
    public $participantFrames;

    /**
     * Represents how many milliseconds into the game the frame occurred.
     * @var long 
     */
    public $timestamp;

    function __construct($d) {
        $this->events = [];
        foreach ($d->events as $o) {
            $this->events[] = new Event($o);
        }
        $this->participantFrames = [];
        foreach ($d->participantFrames as $key => $o) {
            $this->participantFrames[$key] = new ParticipantFrame($o);
        }
        $this->timestamp = $d->timestamp;
    }

    /**
     * Develve en un array los eventos del tipo pasado
     * @param string $eventType Usar Event::EVENTTYPE_...
     * @return Event array
     */
    public function getEventsOfType($eventType) {
        $aResult = [];
        foreach ($this->events as $event) {
            if ($event->eventType == $eventType) {
                $aResult[] = $event;
            }
        }
        return $aResult;
    }

}
