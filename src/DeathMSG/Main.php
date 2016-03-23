<?php
namespace DeathMSG;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\network\protocol\SetTimePacket;
use pocketmine\network\protocol\TextPacket;
use pocketmine\network\protocol\AddPlayerPacket;
use pocketmine\entity\Entity;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\math\AxisAlignedBB;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\Sound;
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
     
                  $player->sendTip(TF::RED." you killed by ".TF::GREEN.$killer->getName().TF::RED." with ".TF::GREEN.$killer->getHealth());
                  $killer->sendTip(TF::YELLOW."+1 ".TF::DARK_AQUA."for killing ".TF::YELLOW.$player->getName());
                  $killer->getLevel()->addSound($click);
             $killer->setHealth($killer->setMaxHealth());
            
		}
            }
        }
    }
}
