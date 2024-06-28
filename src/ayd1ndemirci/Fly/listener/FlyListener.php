<?php

namespace ayd1ndemirci\Fly\listener;

use ayd1ndemirci\Fly\Main;
use ayd1ndemirci\Fly\manager\FlyManager;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class FlyListener implements Listener
{

    function onEntityTeleportEvent(EntityTeleportEvent $event): void
    {
        $player = $event->getEntity();
        if (!$player instanceof Player) return;
        $to = $event->getTo();
        $blacklist_worlds = Main::getInstance()->getConfig()->get("blacklisted-worlds", []);

        if (in_array($to->getWorld()->getFolderName(), $blacklist_worlds)) {
            $player->setFlying(false);
            $player->setAllowFlight(false);
            $player->sendMessage(FlyManager::translate("fly-disabled-in-world", ["{world}" => $player->getWorld()->getFolderName()]));
        }
    }
}