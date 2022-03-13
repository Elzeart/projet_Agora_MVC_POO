<?php
class Toolbox {
/*     public const COULEUR_ROUGE = "alert-danger";
    public const COULEUR_ORANGE = "alert-warning";
    public const COULEUR_VERTE = "alert-success"; */

    public const COOKIE_NAME = 'timers';

/*     public static function ajouterMessageAlerte($message,$type){
        $_SESSION['alert'][]=[
            "message" => $message,
            "type" => $type
        ];
    } */

    public static function secureHTML($chaine){
        return htmlspecialchars(strip_tags(trim($chaine)));
    }

    public static function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");
    
        if(!file_exists($dir)) mkdir($dir,0777);
    
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }

/*     public static function sendMail($destinataire, $sujet, $message){
        $headers = "From: luipourquoi1@gmail.com";
        if(mail($destinataire,$sujet,$message,$headers)){
            self::ajouterMessageAlerte("Mail envoyé", self::COULEUR_VERTE);
        } else {
            self::ajouterMessageAlerte("Mail non envoyé", self::COULEUR_ROUGE);
        }
    } */

/*     public static function genererCookieConnexion(){
        $ticket = session_id().microtime().rand(0,99999);
        $ticket = hash("sha512",$ticket);
        setcookie(self::COOKIE_NAME,$ticket,time()+(60*20));
        $_SESSION['profil'][self::COOKIE_NAME] = $ticket;
    }

    public static function checkCookieConnexion(){
        return $_COOKIE[self::COOKIE_NAME] === $_SESSION['profil'][self::COOKIE_NAME];
    } */

}