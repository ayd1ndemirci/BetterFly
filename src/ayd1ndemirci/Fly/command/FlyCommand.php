<?php

namespace ayd1ndemirci\Fly\command;

use ayd1ndemirci\Fly\manager\FlyManager;
use pocketmine\command\CommandSender;
use pocketmine\command\defaults\VanillaCommand;
use pocketmine\permission\DefaultPermissionNames;
use pocketmine\player\Player;
use pocketmine\Server;

class FlyCommand extends VanillaCommand
{
    public function __construct()
    {
        parent::__construct(
            "fly",
            FlyManager::translate("command-description"),
            "/fly [oyuncu]"
        );

        $this->setPermissions(["fly.command", DefaultPermissionNames::GROUP_OPERATOR, "fly.admin"]);
        $this->setPermissionMessage(FlyManager::translate("no-permission"));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$this->testPermission($sender)) {
            $sender->sendMessage($this->getPermissionMessage());
            return;
        }

        if ($sender instanceof Player) {
            if (empty($args[0])) {
                $this->toggleFly($sender, $sender);
            } else {
                if (Server::getInstance()->isOp($sender->getName())) {
                    $target = Server::getInstance()->getPlayerByPrefix($args[0]);
                    if ($target instanceof Player) {
                        $this->toggleFly($sender, $target);
                    } else {
                        $sender->sendMessage(FlyManager::translate("player-not-found", ["player" => $args[0]]));
                    }
                } else {
                    $sender->sendMessage(FlyManager::translate("no-op-permission"));
                }
            }
        } else {
            if (empty($args[0])) {
                $sender->sendMessage(FlyManager::translate("usage-console"));
            } else {
                $target = Server::getInstance()->getPlayerByPrefix($args[0]);
                if ($target instanceof Player) {
                    $this->toggleFly($sender, $target);
                } else {
                    $sender->sendMessage(FlyManager::translate("player-not-found", ["player" => $args[0]]));
                }
            }
        }
    }

    protected function toggleFly(CommandSender $sender, Player $target): void
    {
        $isFlying = $target->getAllowFlight();

        $target->setAllowFlight(!$isFlying);
        $target->setFlying(!$isFlying);

        $target->sendMessage(FlyManager::translate($isFlying ? "fly-command-off" : "fly-command-on", ["player" => $target->getName()]));
        if ($sender !== $target) {
            $sender->sendMessage(FlyManager::translate($isFlying ? "fly-command-off-other" : "fly-command-on-other", ["player" => $target->getName()]));
        }
    }
}
