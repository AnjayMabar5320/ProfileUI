<?php

namespace AnjayMabar;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ExecutorCommand;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat as C;

use pocketmine\event\Listener;

use AnjayMabar\form_by_jojoe\FormAPI;
use AnjayMabar\form_by_jojoe\SimpleForm;
use AnjayMabar\form_by_jojoe\CustomForm;
use AnjayMabar\form_by_jojoe\ModalForm;
use AnjayMabar\Main;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info(C::GREEN . "[Enabled] ProfileUI By AnjayMabar Aktif");
    }

    public function onLoad(){
        $this->getLogger()->info(C::YELLOW . "
		       mmmm                                                            mmmm      mmmm
              mm  mm                                                           mm mm    mm mm
             mm    mm       nnnn   nn    nnnn        nnnnn       nn   nn       mm  mm  mm  mm        nnnnn       nnnnnnn         nnnnn       nnnnnnn
            mm  mm  mm      nn nn  nn      nn       nn   nn      nn   nn       mm   mmmm   mm       nn   nn      nn    nn       nn   nn      nn    nn
           mm        mm     nn  nn nn      nn      nn     nn      nmnmn        mm          mm      nn     nn     nnnnnnn       nn     nn     nnnnnnn
          mmm        mmm    nn   nnnn      nn     nn mmmmm nn        nm        mm          mm     nn mmmmm nn    nn    nn     nn mmmmm nn    nn    nn
         mmm          mmm   nn     nn  nn  nn    nn         nn  nm  nm         mm          mm    nn         nn   nnnnnnn     nn         nn   nn     nn
                                        nnnn                      nm           
  ");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "[Disable] Plugin Terdapat Error / Butuh FormAPI");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "profile":
                if($sender instanceof Player){
                    $this->ProfileUI($sender);
                }else{
                    $sender->sendMessage("§cGunakan Command Dalam Game!");
                } 
                break;
        }
        return true;
    }

    public function ProfileUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
            	case 0:
                $sender->sendMessage("§cKeluar Dari ProfileUI");
                break;

                }
            });
            $name = $sender->getName();
            $online = count($this->getServer()->getOnlinePlayers());
            $max = $this->getServer()->getMaxPlayers();
            $location = count($sender->getLevel()->getPlayers());
            $world = $sender->getLevel()->getName();
            $ping = $sender->getPing();
            $tps = $sender->getServer()->getTicksPerSecond();
            $x = intval($sender->getX());
            $y = intval($sender->getY());
            $z = intval($sender->getZ());
            $xp = $sender->getXpLevel($sender);
            $level_players = count($sender->getLevel()->getPlayers());
            $item_count = $sender->getInventory()->getItemInHand()->getCount();
            $item_meta = $sender->getInventory()->getItemInHand()->getDamage();
            $item_id = $sender->getInventory()->getItemInHand()->getId();
            $item_name = $sender->getInventory()->getItemInHand()->getName();
            $form->setTitle("ProfileUI");
            $form->setContent("§l§aWelcome, §e{$name}\n\n§f=========\n§bStatic\n§f=========§r\n\n §aOnline §e: §b{$online}§f/§b{$max}\n §aXP Kamu §e: §b{$xp}\n §aLevel Kamu §e: §b{$level_players}\n §aKordinat §e: §b{$x} §f| §b{$y} §f| §b{$z}\n\n§f§l=========\n§bInfo\n§f=========§r\n\n §aSpawn §e: §b{$world}\n §aPlayers §e: §b{$location}\n §aSinyal §e: §b{$ping}§6MS\n §aTPS Kamu §e: §b{$tps}\n §aIP Server : §bsansteam.zapto.org\n §aPORT Server : §b19132 (Default)\n\n§f§l=========\n§bItem Kamu\n§f=========§r\n\n §aItem Name §e: §b{$item_name}\n §aItem ID §e: §b{$item_id}\n §aItem Meta §e: §b{$item_meta}\n §aItem Count §e: §b{$item_count}\n\n\n§ewww.sansteam.zapto.org");
            $form->addButton("§cKeluar\n§aTap to exit");
            $form->sendToPlayer($sender);
            return $form;
    }
	
	
	
	
}