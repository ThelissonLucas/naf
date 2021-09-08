<div class="container">
    </br>
        <h2>Recherche</h2>
        </br>
        <div class="card">
            <div class="container">

                <form name="form1" method="get" action="recherche.php">
                <h3>Critères géographiques</h3>
                    <li>Region : </li>
                    <select cols='100' rows='10' class="form-control" name="nPoste">
                    <option selected="selected"></option>
                            <?php
                                for ($i = 0; $i < count($lesRegs); $i++) {?>
                                { ?>  
                                    <option value="<?php echo $lesRegs[$i]['region']; ?>"><?php echo $lesRegs[$i]['region'];?></option>
                            <?php
                                } ?>
                    </select>

                    <li>Departement : </li>
                    <select cols='100' rows='10' class="form-control" name="nPoste">
                    <option selected="selected"></option>
                            <?php
                                for ($i = 0; $i < count($lesDeps); $i++) {?>
                                { ?>  
                                    <option value="<?php echo $lesDeps[$i]['cp']; ?>"><?php echo $lesDeps[$i]['nom'];?></option>
                            <?php
                                } ?>
                    </select>
                    <br />
                    <h3>Critères sectoriels</h3>

                    <li>Section : </li>
                    <select cols='100' rows='10' class="form-control" name="nPoste">
                    <option selected="selected"></option>
                            <?php
                                for ($i = 0; $i < count($lesSecs); $i++) {?>
                                { ?>  
                                    <option value="<?php echo $lesSecs[$i]['section_code']; ?>"><?php echo $lesSecs[$i]['section_libelle'];?></option>
                            <?php
                                } ?>
                    </select>

                    <li>Division : </li>
                    <select cols='100' rows='10' class="form-control" name="nPoste">
                    <option selected="selected"></option>
                            <?php
                                for ($i = 0; $i < count($lesDivs); $i++) {?>
                                { ?>  
                                    <option value="<?php echo $lesDivs[$i]['division_code']; ?>"><?php echo $lesDivs[$i]['division_libelle'];?></option>
                            <?php
                                } ?>
                    </select>

                    <br />
		            <input type="submit" value="Recherche" name="submit"></input>
	            </form>
                
            </div>
        </div>
</div>
