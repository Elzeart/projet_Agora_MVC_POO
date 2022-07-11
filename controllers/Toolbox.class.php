<?php
class Toolbox {

    public static function secureHTML($chaine){
        return htmlspecialchars(strip_tags(trim($chaine)));
    }

    public static function ajoutImage($file, $dir){
        // On vérifie si un fichier a été envoyé
        if(isset($file) && $file['error']===0){
            // On définit les variables pour ensuite vérifier l'extension et le type
            $tabExtType = [
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png"
            ];
            $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            $fileType = $file['type'];

            // On vérifie l'abscence de l'extension dans les clés de $tabExtType ou l'abscence du type MIME dans les valeurs
            if(!array_key_exists($extension,$tabExtType ) && !in_array($fileType, $tabExtType)){
                $_SESSION['alert'] []= ["type" => "danger","message" => "Format de fichier incorrect"];
                die(header('Location: '. URL . "admin/pAdmin"));
            }

            // On limite à 1Mo
            if($file['size'] > 1024 * 1024){
                $_SESSION['alert'] []= ["type" => "danger","message" => "Format de fichier trop volumineux"
                ];
                die(header('Location: '. URL . "admin/pAdmin"));
            }

            if(!file_exists($dir)){
                mkdir($dir,0644);
            }

            // On génére un nom uniquement
            $newName = md5(uniqid()) ;
            // On génére le chenmin
            $target_file = $dir.$newName."_".$file['name'];
            
            if(file_exists($target_file)){
                $_SESSION['alert'] []= ["type" => "danger","message" => "Le nom de fichier existe déjà"];
                die(header('Location: '. URL . "admin/pAdmin"));
            }

            if(!move_uploaded_file($file['tmp_name'], $target_file)){
                $_SESSION['alert'] []= ["type" => "danger","message" => "L'ajout de l'image n'a pas fonctionné"];
                die(header('Location: '. URL . "admin/pAdmin"));
            }
            else {
                chmod($target_file, 0644); //On interdit l'exécution du fichier. Le fichier peut être lu mais pas exécuté
                return ($newName."_".$file['name']);
            }
        }
    }
}


 /* if(!isset($file['name']) || empty($file['name'])){
            throw new Exception("Vous devez indiquer une image");
        }
        
        if(!file_exists($dir)){
        mkdir($dir,0777);
        }

        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"])){
            throw new Exception("Le fichier n'est pas une image");
        }
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif"){
            throw new Exception("L'extension du fichier n'est pas reconnu");
        }
        if(file_exists($target_file)){
            throw new Exception("Le fichier existe déjà");
        }
        if($file['size'] > 500000){
            throw new Exception("Le fichier est trop gros");
        }
        if(!move_uploaded_file($file['tmp_name'], $target_file)){
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        }
        else {
            return ($random."_".$file['name']);
        } */
