<?php

namespace ayd1ndemirci\Fly\manager;

use ayd1ndemirci\Fly\Main;

class FlyManager
{
    private static array $translations = [];

    public static function init(): void
    {
        $languageConfig = Main::getInstance()->getLanguageConfig();
        self::$translations = $languageConfig->getAll();
    }

    /**
     * Translate a given key using the loaded translations.
     *
     * @param string $key
     * @param array $replacements
     * @return string
     */
    public static function translate(string $key, array $replacements = []): string
    {
        $message = self::$translations[$key] ?? $key;
        foreach ($replacements as $search => $replace) {
            $message = str_replace("{" . $search . "}", $replace, $message);
        }
        return $message;
    }
}
