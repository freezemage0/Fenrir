<?php

namespace Exan\Dhp\Component\Button;

use Exan\Dhp\Enums\Component\ButtonStyle;

class SecondaryButton extends InteractionButton
{
    protected ButtonStyle $style = ButtonStyle::Secondary;
}