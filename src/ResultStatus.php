<?php

namespace Ebuyer\Totem;

enum ResultStatus: string
{
    case QUEUED = 'Queued';
    case RUNNING = 'Running';
    case SUCCESS = 'Success';
    case FAILED = 'Failed';
}
