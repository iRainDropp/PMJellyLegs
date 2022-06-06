<?php

declare(strict_types=1);

namespace iRainDrop\PMJellyLegs;

use iRainDrop\PMJellyLegs\Commands\JellyLegsCommand;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{

    public array $players = [];
    public static $config;

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener($this), $this);
        $this->getServer()->getCommandMap()->register("PMJellyLegs", new JellyLegsCommand ($this));
        $this->saveresource("config.yml");
        self::$config = new Config($this->getDataFolder() . "config.yml");
    }

    public function setJelly(Player $player){
        $name = $player->getName();
        if(isset($this->players[$name])){
            unset($this->players[$name]);
            $player->sendMessage(C::RED . "You have disabled JellyLegs, you will now take fall-damage.");
        }
        else{
            $this->players[$name] = true;
            $player->sendMessage(C::GREEN . "You have enabled JellyLegs, you will no longer take fall-damage.");
        }
    }

    public function hasJelly(Player $player){
        $name = $player->getName();
        if(isset($this->players[$name])){
            return true;
        }
        return false;
    }
}
