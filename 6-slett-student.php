<?php /* slett-student */
/*
/* Programmet lager et skjema for å velge en student som skal slettes
/* Programmet sletter den valgte studenten
*/
?>

<script src="funksjoner.js"></script>

<h3>Slett student</h3>

<?php
  include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */

  if (isset($_POST ["slettStudentKnapp"]))
  {
    $Brukernavn=$_POST ["Brukernavn"];

    $sqlSetning="DELETE FROM student WHERE brukernavn='$Brukernavn';";
    mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
    /* SQL-setning sendt til database-serveren */

    print ("F&oslash;lgende student er n&aring; slettet: $Brukernavn <br/><br/>");
  }
?>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
Student
<select id="Brukernavn" name="Brukernavn" required>
<option value="">velg student</option>
<?php
  $sqlSetning="SELECT * FROM student ORDER BY brukernavn;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
  $antallRader=mysqli_num_rows($sqlResultat);

  for ($r=1;$r<=$antallRader;$r++)
  {
    $rad=mysqli_fetch_array($sqlResultat);
    $brukernavn=$rad["brukernavn"];
    $fornavn=$rad["fornavn"];
    $etternavn=$rad["etternavn"];

    print ("<option value='$brukernavn'>$brukernavn $fornavn $etternavn</option>");
  }
?>
</select> <br/>
<input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp" />
</form>
