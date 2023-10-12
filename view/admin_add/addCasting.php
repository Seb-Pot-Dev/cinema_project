<?php
ob_start();
?>
<form action="index.php?action=addCasting" method="post">
<label for="actor_id">Acteur: </label>           
        <select name ="actor_id" id="actor_id">
            <option value="" disabled selected>Acteur</option>
            <?php 
                foreach($requestActor->fetchAll() as $actor){
                    echo "<option value='".$actor['id_actor']."'>".$actor['actor_fullname']."</option>";
                }; ?>
        </select> 
        
<label for="movie_id">Nom du film : </label>           
        <select name ="movie_id" id="movie_id">
            <option value="" disabled selected>Film</option>
            <?php 
            
                foreach($requestMovie->fetchAll() as $movie){
                    echo "<option value='".$movie['id_movie']."'>".$movie['movie_name']."</option>";
                }; ?>
        </select> 
        
<label for="role_id">Rôle: </label>           
        <select name ="role_id" id="role_id">
            <option value="" disabled selected>Rôle</option>
            <?php 
                foreach($requestRole->fetchAll() as $role){
                    echo "<option value='".$role['id_role']."'>".$role['role_name']."</option>";
                }; ?>
        </select> 
        
<input type="submit" name="submit">
</form>

<?php
$title = "Ajouter un casting";
$secondary_title = "Ajouter un casting a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>