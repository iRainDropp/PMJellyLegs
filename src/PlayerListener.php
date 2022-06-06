<?php


namespace iRainDrop\PMJellyLegs;


use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class PlayerListener implements Listener
{
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function playerFall(EntityDamageEvent $e){
        $cause = $e->getCause();
        $world = $e->getEntity()->getWorld()->getDisplayName();
        if($cause === EntityDamageEvent::CAUSE_FALL){
            $player = $e->getEntity();
            if($player instanceof Player && !in_array($world, Main::$config->get("Disabled Worlds"))){
                if(Main::$config->get("Disable All Fall-Damage") == true){
                    $e->cancel();
                    return;
                }
                if($this->plugin->hasJelly($player)) {
                    $e->cancel();
                }
            }
        }
    }
}