<?php

namespace health\panda;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

	public function onEnable() {
		@mkdir($this->getDataFolder());
		
		$this->saveResource("config.yml");
		$this->saveDefaultConfig();
		$this->getLogger()->info(TextFormat::GREEN . "MoreHealth was loaded!");
	}
	
	public function onDisable() {
		$this->getLogger()->info(TextFormat::RED . "MoreHealth was unloaded!");
	}
	
	public function onCommand(CommandSender $s, Command $cmd, string $label, array $args) : bool {
		switch($cmd->getName()) {
		
		case "morehealth":
			if($s instanceof Player) {
				if($s->hasPermission("health.command")) {
					$s->setMaxHealth($this->getConfig()->get("maxhealth-health"));
					$s->setHealth($this->getConfig()->get("maxhealth-health"));
					$s->sendMessage(TextFormat::GREEN . $this->getConfig()->get("maxhealth-message"));
				} else {
					$s->sendMessage(TextFormat::RED . $this->getConfig()->get("no-permission"));
				}
			} else {
				$s->sendMessage(TextFormat::RED . "Use this command In-Game!");
			}
		break;
		
		case "normal":
			if($s instanceof Player) {
				if($s->hasPermission("health.command")) {
					$s->setMaxHealth(20);
					$s->setHealth(20);
					$s->sendMessage(TextFormat::GREEN . $this->getConfig()->get("normal-message"));
				} else {
					$s->sendMessage(TextFormat::RED . $this->getConfig()->get("no-permission"));
				}
			} else {
				$s->sendMessage(TextFormat::RED . "Use this command In-Game!");
			}
		break;
		}
	return true;
	}
}