<?php

namespace nfstw;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\Server;
use nfstw\CallbackTask;
use onebone\economyapi\EconomyAPI;
use pocketmine\level\Level; 
use pocketmine\inventory\Inventory;

 



class TipSender extends PluginBase{

 public function onEnable(){
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this,"sendTipSender"]), 9);


 }

 
 
  	public function sendTipSender(){

   		       

     	
   	$z = count($this->getServer()->getOnlinePlayers());
//獲取在線人數
		date_default_timezone_set('Asia/Taipei'); //設定為台灣台北時區
		foreach($this->getServer()->getOnlinePlayers() as $player){


			 	if($player->isOnline()){
			 	
       	
		

 			
		 $m = EconomyAPI::getInstance()->myMoney($player->getName());
		$wn = $player->getLevel()->getName();
      $beibao = $player->getInventory();
	   $item = $beibao->getItemInHand();
      $id = $item->getID();
      $sl = $item->getcount();
      $ts = $item->getDamage();
			    if ($player->isOp()) {
                   $quanxian = "管理員";
                } else {
                    $quanxian = "玩家";
}
                
       



				$player->sendPopup("§f|目前 $z 人在線 §d剩餘 $m 元 §e手持 $id:$ts §2數量 $sl 個\n§f|§c權限 : $quanxian  §b目前時間 ".date("H")." :".date("i")." :".date("s")."  §6您在 $wn 世界");
	

 
}
}




} 
 }
