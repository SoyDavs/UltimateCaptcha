<?php

namespace SoyDavs\UltimateCaptcha;

use pocketmine\plugin\PluginBase;
use SoyDavs\UltimateCaptcha\listeners\EventListener;
use SoyDavs\UltimateCaptcha\commands\CaptchaCommand;

class Main extends PluginBase {

    private $config;
    private $captchaManager;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();

        $this->captchaManager = new CaptchaManager($this);

        $this->getServer()->getPluginManager()->registerEvents(
            new EventListener($this, $this->captchaManager),
            $this
        );

        $this->getServer()->getCommandMap()->register(
            "ultimatecaptcha", 
            new CaptchaCommand($this) 
        );

        $this->getLogger()->info("§aUltimateCaptcha by SoyDavs Enabled");
    }

    public function getCaptchaManager(): CaptchaManager {
        return $this->captchaManager;
    }
}
