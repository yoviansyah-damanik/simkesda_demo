<?php

namespace App\Helpers;

use Jenssegers\Agent\Agent;

class AgentHelper
{
    public static function get_agent()
    {
        $agent = new Agent();

        $new_agent = [
            'device' => $agent->device(),
            'browser' => $agent->browser() . ' ' . $agent->version($agent->browser()),
            'os' => $agent->platform() . ' ' . $agent->version($agent->platform()),
            'robot' => $agent->robot(),
        ];

        return $new_agent;
    }
}
