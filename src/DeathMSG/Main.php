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
class Main extends PluginBase implements Listener {
 
    

  public function onEnable()
  {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info("DeathMSG has been enabled.");
 
           
    }
    
    public function onDeath(PlayerDeathEvent $event)  {
        $cause = $event->getEntity()->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent) {
            $player = $event->getEntity();
            $killer = $cause->getDamager();
 $p = $event->getEntity();
             if ($killer instanceof Player){
                  $click = new ClickSound($killer);
                  $Launch = new LaunchSound($player);
     
                  $player->sendTip(TextFormat::DARK_RED."You've been killed by " .TextFormat::DARK_GRAY. $killer->getName(). TextFormat::DARK_AQUA. "with ". TextFormat::YELLOW. $killer->getHealth(). TextFormat::DARK_AQUA. "Hearts Remining! ");
                  $killer->sendTip(TextFormat::DARK_RED."You killed  " .TextFormat::DARK_GRAY. $player->getName(). TextFormat::DARK_AQUA. "with ". TextFormat::YELLOW. $killer->getHealth(). TextFormat::DARK_AQUA. "Hearts Remining! ");
                  $player->getLevel()->addSound($Launch);
                  $killer->getLevel()->addSound($click);
             $killer->setHealth($killer->setMaxHealth()); }
		}
            }
        }


