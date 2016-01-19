<?php
namespace User\Service;

class Timer
{
    /**
     * Start times.
     * @var array
     */
    protected $start;
     
    /**
     * Defines if the time must be presented as float
     * @var boolean
     */
    protected $timeAsFloat;

    public function __construct($timeAsFloat = false)
    {
        $this->timeAsFloat = $timeAsFloat;
        echo "<p>Timer constructor loaded.</p>";
    }

    /**
     * Starts measuring time
     * @param  string  $key
     */
    public function start($key)
    {
        $this->start[$key] = microtime($this->timeAsFloat);
    }

    /**
     * Stops measuring the time
     * @param string $key
     * @return float|null the duration of the event
     */
    public function stop($key)
    {
        if(!isset($this->start[$key]))
        {
            return null;
        }

        return microtime($this->timeAsFloat) - $this->start[$key];
    }
}