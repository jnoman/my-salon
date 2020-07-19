
<?php
date_default_timezone_set('Africa/Casablanca');
$duree = intval($_GET['duree']);
$id = intval($_GET['id']);
$date=$_GET['date'];
if($duree)
{
    $con = mysqli_connect('localhost','root','','mySalon');
    if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }

    mysqli_select_db($con,"ajax_demo");
    $sql1="SELECT date_debut_travail,date_fin_travail FROM salon WHERE id_salon=$id";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_array($result1);
    $sql="SELECT (a.date_debut + INTERVAL a.duree MINUTE) AS free_after FROM resrvation a,employe WHERE NOT EXISTS ( SELECT 1 FROM resrvation b,employe WHERE b.id_employe=employe.id_employe and employe.id_salon=$id and b.date_debut BETWEEN (a.date_debut + INTERVAL a.duree MINUTE) AND (a.date_debut + INTERVAL a.duree MINUTE) + INTERVAL ".$duree." MINUTE - INTERVAL 1 MICROSECOND) AND if(CURRENT_DATE='$date', (a.date_debut + INTERVAL a.duree MINUTE) BETWEEN CURRENT_TIMESTAMP AND '$date 19:43:50',(a.date_debut + INTERVAL a.duree MINUTE) BETWEEN '$date ".$row1['date_debut_travail']."' AND '$date ".$row1['date_fin_travail']."') and a.id_employe=employe.id_employe and employe.id_salon=$id";
    $result = mysqli_query($con,$sql);

    if($row = mysqli_fetch_array($result)) {
        echo "rendez-vous commence à : <p style='display: inline;'>".date("H:i",strtotime($row['free_after']))."</p>";
        echo '<input type="hidden" name="timeReserv" value="'.date("H:i:s",strtotime($row1['free_after'])).'">';
        echo '<button type="submit" class="btn btn-info btn_stndard" name="ajouterReservation">Reserver</button>';
    }
    else
    {
        if($date==date('Y-m-d'))
        {
            if(date("H:i",strtotime(date("H:i")." +10 minutes + $duree minutes"))<date("H:i",strtotime($row['date_fin_travail'])))
            {
                echo "rendez-vous commence à : <p style='display: inline;'>".date("H:i",strtotime(date("H:i")." +10 minutes"))."</p>";
                echo '<input type="hidden" name="timeReserv" value="'.date("H:i:s",strtotime(date("H:i")." +10 minutes")).'">';
                echo '<button type="submit" class="btn btn-info btn_stndard" name="ajouterReservation">Reserver</button>';
            }
            else
            {
                echo "La date de réservation n'est pas disponible. Vous souhaitez choisir une autre date?";
            }
        }
        else
        {
            echo "rendez-vous commence à : <p style='display: inline;'>".date("H:i",strtotime($row1['date_debut_travail']))."</p>";
            echo '<input type="hidden" name="timeReserv" value="'.date("H:i:s",strtotime($row1['date_debut_travail'])).'">';
            echo '<button type="submit" class="btn btn-info btn_stndard" name="ajouterReservation">Reserver</button>';
        }
    }
    mysqli_close($con);
}
?>