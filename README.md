# Fly Plugin

Fly Plugin is a plugin for PocketMine that allows players to toggle flight mode and supports language localization.

## Features

- Toggle flight mode for players.
- Command-based flight management.
- Multi-language support (via config files).

## Installation

1. **Downloading the Plugin:**
    - Download or copy the plugin to your PocketMine server.

2. **Configuration Files:**
    - Edit the `config.yml` file to configure language and other settings.
    - Optionally, edit or add language files (`eng.yml`, `tur.yml`, etc.).

3. **Restart Server:**
    - Restart the server or load the plugin into PocketMine.

## Usage

- `/fly` - Toggle your own flight mode.
- `/fly <player>` - Toggle flight mode for the specified player (OP-only).

## Commands

- `/fly` - Toggle your own flight mode.
- `/fly <player>` - Toggle flight mode for the specified player.

## Permissions

- `fly.command` - Permission to use the `/fly` command.
- `fly.admin` - Permission to manage flight mode for other players (OP-only).

## Language Support

The plugin supports multi-language localization through config files. The default language file is set to `eng.yml`, and additional languages can be added optionally.

## Contributing

Contributions are welcome! You can contribute to improving the plugin or fixing bugs by submitting pull requests.

## License

This project is licensed under the MIT License. For more details, see the `LICENSE` file.
