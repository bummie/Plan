<h3>Ny skole</h3>
			<form action="../getters/get_newschool.php" method="post">
            <br />
            <b><h5>Skoledata</h5></b><br />
            SkoleID: <input name="skole_id" type="number" value="0" />&nbsp;SkoleKode: <input name="skole_kode" type="number" value="0" /><br />
            Type_fra: <input name="skole_type_fra" type="number" value="0" />
            Type_til: <input name="skole_type_til" type="number" value="1" />

            <div>
                &nbsp;</div>
            <p>
                <h5>Database</h5><br/>
                
                Host: <input name="db_host" type="text" value="localhost" /> <br/>
                
                Brukernavn: <input name="db_brukernavn" type="text" value="" /> <br/>
                
                Passord: <input name="db_passord" type="password" value="" /> <br/>
                
                <br/>

                <b><h5>Databaseplassering</h5></b> <br/>
                Database: <input maxlength="50" name="db_database" type="text"/> Tabell: <input maxlength="50" name="db_tabell" type="text" /></p>
            <p><b><h5>Ekstra</h5></b></p>
            <p>Skolenavn:&nbsp;<input maxlength="50" name="ekstra_skolenavn" type="text" /></p>
            <p>Ukefiks<b><input name="ekstra_fiks" type="checkbox" value="true" /></b></p>
            <p><input name="btn_newschool" type="Submit" value="Ny skole" /></p>

        </form>		
