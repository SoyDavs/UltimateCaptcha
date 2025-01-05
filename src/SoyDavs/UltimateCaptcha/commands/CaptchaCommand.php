<?php

namespace SoyDavs\UltimateCaptcha\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use SoyDavs\UltimateCaptcha\Main;

class CaptchaCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin){
        parent::__construct(
            "captcha",
            "Forces the captcha form to appear again",
            "/captcha"
        );
        $this->plugin = $plugin;
        $this->setPermission("ultimatecaptcha.command.captcha");
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if(!$sender instanceof Player){
            $sender->sendMessage("This command can only be used in-game.");
            return false;
        }

        if(!$sender->hasPermission("ultimatecaptcha.command.captcha")){
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return false;
        }

        $this->plugin->getCaptchaManager()->showCaptcha($sender);
        $sender->sendMessage("§aCaptcha has been forced. Please complete it!");
        return true;
    }
}
