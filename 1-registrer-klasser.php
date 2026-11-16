<?php  /* registrer-poststed */
/*
/*  Programmet lager et html-skjema for å registrere et poststed
/*  Programmet registrerer data (postnr og poststed) i databasen
*/
?> 

<h3>Registrer klassekode </h3>

<form method="post" action="" id="registrerKlassekodeSkjema" name="registrerKlassekodeSkjema">
  Klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  Klassenavn <input type="text" id="Klassenavn" name="Klassenavn" required /> <br/>
  Studiumkode <input type="text" id="Studiumkode" name="Studiumkode" required /> <br/>
  <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerKlasseKnapp"]))
    {
      $Klassekode=$_POST ["klasse"];
      $Klassenavn=$_POST ["klassenavn"];
      $Studiumkode=$_POST ["studiumkode"];

      include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM poststed WHERE postnr='$Klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klassen er registrert fra før */
            {
              print ("Klassen er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Klassekode VALUES('$Klassekode','$Klassenavn', '$Studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klasse er n&aring; registrert: $Klassekode $Klassenavn $Studiumkode; 
            }
    }
?> 
