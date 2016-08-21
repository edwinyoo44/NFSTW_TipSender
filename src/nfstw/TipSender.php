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
use pocketmine\level\Level; 
use pocketmine\inventory\Inventory;

use onebone\economyapi\EconomyAPI;


class TipSender extends PluginBase{
	public function onEnable(){
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this,"sendTipSender"]), 9);
	}

 
 
  	public function sendTipSender(){
		$z = count($this->getServer()->getOnlinePlayers());//獲取在線人數
		date_default_timezone_set('Asia/Taipei'); //設定為台灣台北時區
		foreach($this->getServer()->getOnlinePlayers() as $player){
			
			if($player->isOnline()){
				$money = EconomyAPI::getInstance()->myMoney($player->getName());
				$world = $player->getName()->getLevel()->getFolderName();
				
				$inven = $player->getName()->getInventory();
				$item = $inven->getItemInHand();
				$id = $item->getId();
				$ts = $item->getDamage();
				
				$s = $this->plugin->getServer();
				$tps = (int)$s->getTicksPerSecondAverage();
				$cpu = (int)$s->getTickUsageAverage();
				
				$x = (int)$player->getName()->getX();
				$y = (int)$player->getName()->getY();
				$z = (int)$player->getName()->getZ();
				
				$yaw = (int)$player->getName()->getYaw();
					if (22.5 <= $yaw && $yaw < 67.5) {
						$bearing = "西北方";
					} elseif (67.5 <= $yaw && $yaw < 112.5) {
						$bearing = "北方";
					} elseif (112.5 <= $yaw && $yaw < 157.5) {
						$bearing = "東北方";
					} elseif (157.5 <= $yaw && $yaw < 202.5) {
						$bearing = "東方";
					} elseif (202.5 <= $yaw && $yaw < 247.5) {
						$bearing = "東南方";
					} elseif (247.5 <= $yaw && $yaw < 292.5) {
						$bearing = "南方";
					} elseif (292.5 <= $yaw && $yaw < 337.5) {
						$bearing = "西南方";
					} else {
						$bearing = "西方";
					}
					
					if ($player->isOp()) {
						$quanxian = "管理員";
					} else {
						$quanxian = "玩家";
					}
					
				$player->sendTip("§d剩餘 $money 元 §b目前時間 ".date("H")." :".date("i")." :".date("s")." §a手持: $id:$ts\n§b在線: $online §e座標: §l$wn §e($x:$y:$z)$bearing");
				$player->sendPopup("§6權限: $quanxian §3穩定度: $tps §3負載量: $cpu%\n§d本功能由夜喵(edwinyoo44)製作,勿刪除版權宣告");
				}
		}

	} 
}
