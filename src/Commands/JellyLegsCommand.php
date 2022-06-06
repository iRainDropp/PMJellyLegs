<?php

namespace iRainDrop\PMJellyLegs\Commands;

use iRainDrop\PMJellyLegs\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\utils\TextFormat as C;

class JellyLegsCommand extends Command implements PluginOwned
{
    public function __construct(private Main $plugin) {
        parent::__construct("jellylegs", "Enable or disable fall damage for yourself.");
    }

    public function getOwningPlugin(): Main
    { return $this->plugin; }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if(Main::$config->get("Disable All Fall-Damage") == false){
                if($sender->hasPermission("jelly.legs")){
                    $this->plugin->setJelly($sender);
                }
                else{
                    $sender->sendMessage(C::RED . "You do not have permission to use this command.");
                }
            }
            else{
                $sender->sendMessage(C::RED . "Fall-damage is already disabled on this server.");
            }
        }
        else{
            $sender->sendMessage(C::RED . "This command is for player use only.");
        }
    }

}