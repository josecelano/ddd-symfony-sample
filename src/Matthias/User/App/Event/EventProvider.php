<?php

namespace Matthias\User\App\Event;

use SimpleBus\Event\Provider\EventProviderCapabilities;
use SimpleBus\Event\Provider\ProvidesEvents;

class EventProvider implements ProvidesEvents
{
    use EventProviderCapabilities;
}