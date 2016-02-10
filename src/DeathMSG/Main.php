<?php
namespace DeathMSG;

use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\network\protocol\SetTimePacket;
use pocketmine\network\protocol\TextPacket;
use pocketmine\network\protocol\AddPlayerPacket;
use pocketmine\entity\Entity;
use pocketmine\nbt\tag\Byte;
use pocketmine\nbt\tag\Compound;
use pocketmine\nbt\tag\Double;
use pocketmine\nbt\tag\Enum;
use pocketmine\nbt\tag\Float;
use pocketmine\nbt\tag\Int;
use pocketmine\math\AxisAlignedBB;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\LaunchSound;
class Main extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener {
 
    

  public function onEnable()
  {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info("DeathMSG has been enabled.");
 
           
    }
    
    public function onDeath(\pocketmine\event\player\PlayerDeathEvent $event)  {
        $cause = $event->getEntity()->getLastDamageCause();
        if($cause instanceof \pocketmine\event\entity\EntityDamageByEntityEvent) {
            $player = $event->getEntity();
            $killer = $cause->getDamager();
 $p = $event->getEntity();
             if ($killer instanceof \pocketmine\Player){
                  $click = new ClickSound($killer);
                  $Launch = new LaunchSound($player);
     
                  $player->sendMessage(\pocketmine\utils\TextFormat::DARK_RED." You killed by ". \pocketmine\utils\TextFormat::RED.$killer->getName().\pocketmine\utils\TextFormat::DARK_RED." with " . \pocketmine\utils\TextFormat::YELLOW.$killer->getHealth().\pocketmine\utils\TextFormat::DARK_RED." Hearts remining! ");
                  $killer->sendMessage(\pocketmine\utils\TextFormat::GREEN." You killed ". \pocketmine\utils\TextFormat::DARK_AQUA.$player->getName(). \pocketmine\utils\TextFormat::GREEN. " with" . \pocketmine\utils\TextFormat::YELLOW.$killer->getHealth(). \pocketmine\utils\TextFormat::GREEN." Hearts remining! ");
                  $player->getLevel()->addSound($Launch);
                  $killer->getLevel()->addSound($click);
             $killer->setHealth($killer->setMaxHealth());
            
		}
            }
        }

}
