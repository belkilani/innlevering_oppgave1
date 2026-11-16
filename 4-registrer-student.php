<?php /* registrer-student */
/*
/* Programmet lager et html-skjema for å registrere student
/* Programmet registrerer data (student) i databasen
*/
?>

<h3>Registrer student</h3>

<?php
  include("db-tilkobling.php"); /* tilkobling til database-serveren utført og valg av database foretatt */
?>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
Brukernavn <input type="text" id="Brukernavn" name="Brukernavn" required /> <br/>
Fornavn <input type="text" id="Fornavn" name="Fornavn" required /> <br/>
Etternavn <input type="text" id="Etternavn" name="Etternavn" required /> <br/>
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
<input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
<input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br/>
</form>

<?php
if (isset($_POST ["registrerStudentKnapp"]))
{
  $Brukernavn=$_POST ["Brukernavn"];
  $Fornavn=$_POST ["Fornavn"];
  $Etternavn=$_POST ["Etternavn"];
  $Klassekode=$_POST ["Klassekode"];

  $sqlSetning="SELECT * FROM student WHERE brukernavn='$Brukernavn';";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
  $antallRader=mysqli_num_rows($sqlResultat);

  if ($antallRader!=0) /* studenten er registrert fra før */
  {
    print ("Studenten er registrert fra f&oslash;r");
  }
  else
  {
    $sqlSetning="INSERT INTO student VALUES('$Brukernavn','$Fornavn','$Etternavn','$Klassekode');";
    mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
    /* SQL-setning sendt til database-serveren */

    print ("F&oslash;lgende student er n&aring; registrert: $Brukernavn $Fornavn $Etternavn $Klassekode");
  }
}
?>
