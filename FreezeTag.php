<?php
/*
__PocketMine Plugin__
name=FreezeTag
version=0.1.0
author=zgeorge22
class=FreezeTag
apiversion=12
*/

class FreezeTag implements Plugin{
    private $api;
    public function __construct(ServerAPI $api, $server = false){
        $this->api = $api;
    }

    public function init(){
        $this->server->addHandler("entity.health.change",array($this,"eventHandler"));
        $this->api->console->register("startFT", "Starts A Game Of FreezeTag", array($this, "cmdHandler"));
        $this->api->console->register("stopFT", "Stops A Game Of FreezeTag", array($this, "cmdHandler"));
        $this->api->console->register("tagger", "Sets You As A Tagger", array($this, "cmdHandler"));
        $this->api->console->register("runner", "Sets You As A Runner", array($this, "cmdHandler"));
        $this->config = new Config($this->api->plugin->configPath($this)."config.yml", CONFIG_YAML, array(
                "taggers" => array(),
                "runners" => array()
        ));
    }
    
    public function __destruct(){

    }

    public function cmdHandler($cmd, $arg){
        switch($cmd){
            case "tagger":
              $username= $issuer->username;
                if (!in_array($username, $this->config->get("taggers")) && !in_array($username, $this->config->get("runners"))){
                  $c = $this->config->get("taggers");
                  $c[] = $username;
                  $this->config->set("taggers", $c);
                  $this->config->save();
                  console('[FreezeTag] This Player Is Now A Tagger.');
                  return;
                }else{
                console('[FreezeTag] This Player Is Already A Tagger.');
                }
            break;
            case "runner":
                $username= $issuer->username;
                if (!in_array($username, $this->config->get("runners")) && !in_array($username, $this->config->get("taggers"))){
                  $c = $this->config->get("runners");
                  $c[] = $username;
                  $this->config->set("runners", $c);
                  $this->config->save();
                  console('[FreezeTag] This Player Is Now A Runner.');
                  return;
                }else{
                console('[FreezeTag] This Player Is Already A Runner.');
                }
            break;
            case "startFT":
                //Start
            break;
            case "stopFT":
                //Stop
            break;
        }
    }

    public function eventHandler($data, $event){
        switch($event){
            case "entity.health.change":
                $player=$this->api->player->getByEID($data["eid"]);
                if($player instanceof Player){
                    $attacker=$this->api->player->getByEID($data["cause"]);
                    if($attacker instanceof Player){
                        //If Attacker Is Tagger and Player Is Runner Then....
                    }
                }
            break;
        }
    }

}
