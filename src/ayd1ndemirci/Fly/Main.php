<?php

namespace ayd1ndemirci\Fly;

use ayd1ndemirci\Fly\command\FlyCommand;
use ayd1ndemirci\Fly\listener\FlyListener;
use ayd1ndemirci\Fly\manager\FlyManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase
{
    private static Main $main;
    private Config $languageConfig;

    protected function onLoad(): void
    {
        self::$main = $this;
        $this->saveDefaultConfig();
        $this->loadLanguageConfig();
    }

    protected function onEnable(): void
    {
        FlyManager::init();
        $this->getServer()->getCommandMap()->register("fly", new FlyCommand());
        $this->getServer()->getPluginManager()->registerEvents(new FlyListener(), $this);
    }

    /**
     * Load the language configuration file.
     */
    private function loadLanguageConfig(): void
    {
        $language = $this->getConfig()->get("language", "eng");
        $this->saveResource("langs/" . $language . ".yml");
        $this->languageConfig = new Config($this->getDataFolder() . "langs/" . $language . ".yml");
    }

    /**
     * Get the language configuration.
     *
     * @return Config
     */
    public function getLanguageConfig(): Config
    {
        return $this->languageConfig;
    }

    public static function getInstance(): ?self
    {
        return self::$main;
    }
}
