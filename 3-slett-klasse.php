<?php /* slett-klasse */
/*
/* Programmet lager et skjema for å velge en klasse som skal slettes
/* Programmet sletter den valgte klassen
*/
?>

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<?php
  include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */

  if (isset($_POST ["slettKlasseKnapp"]))
  {
    $Klassekode=$_POST ["Klassekode"];

    /* sjekker om klassen har studenter, i så fall kan den ikke slettes */
    $sqlSetning="SELECT * FROM student WHERE klassekode='$Klassekode';";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    $antallRader=mysqli_num_rows($sqlResultat);

    if ($antallRader!=0) /* klassen har studenter */
    {
      print ("Klassen $Klassekode har registrerte studenter og kan ikke slettes <br/><br/>");
    }
    else
    {
      $sqlSetning="DELETE FROM klasse WHERE klassekode='$Klassekode';";
      mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
      /* SQL-setning sendt til database-serveren */

      print ("F&oslash;lgende klasse er n&aring; slettet: $Klassekode <br/><br/>");
    }
  }
?>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
Klasse
<select id="Klassekode" name="Klassekode" required>
<option value="">velg klasse</option>
<?php
  $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
  $antallRader=mysqli_num_rows($sqlResultat);

  for ($r=1;$r<=$antallRader;$r++)
  {
    $rad=mysqli_fetch_array($sqlResultat);
    $klassekode=$rad["klassekode"];
    $klassenavn=$rad["klassenavn"];

    print ("<option value='$klassekode'>$klassekode $klassenavn</option>");
  }
?>
</select> <br/>
<input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp" />
</form>
