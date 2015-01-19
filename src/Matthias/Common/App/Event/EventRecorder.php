<?php

namespace Matthias\Common\App\Event;

use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

class EventRecorder implements ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;
}