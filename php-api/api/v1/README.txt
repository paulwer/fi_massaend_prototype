globale Variablen, methoden, welche pro abschnittimplementiertw erden sollten:
$_GET['lan'] für filter nach aktueller sprache + wenn definiert, nach definierter sprache

	$connection=new APICONNECT();
 	$query="SELECT review.author_name, review.rating, review.text FROM review JOIN rn_languages ON rn_languages.id=review.language WHERE review.id=:id AND review.status=1";
        $arrayData=array(":id" => $_GET['id']);
        if (isset($_GET['lan'])) {
            $query.=" AND rn_languages.description=:language ";
            $arrayData[":language"]=$_SESSION['language'];
            if (!$_GET['lan']=="") {$arrayData[":language"]=substr($_GET['lan'],0,2);}
        }
        $query.=" GROUP BY review.id";
        $result=$connection->execute($query, $arrayData);