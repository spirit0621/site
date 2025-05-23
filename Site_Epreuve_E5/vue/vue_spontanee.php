<center>
    <h1>Postuler</h1>
</center>
<form id="candidatureForm" action="controleur/spontaneeControleur.php" method="post" enctype="multipart/form-data">
    <div id="candidature">
        <label for="cv" class="form-label"><b>CV * :</b></label>
        <input type="file" id="cv" name="cv" class="form-control" accept="application/pdf" required> <br><br>

        <label for="motivation" class="form-label"><b>Lettre de motivation (optionnel) :</b></label>
        <input type="file" id="motivation" name="motivation" class="form-control" accept="application/pdf"> <br><br>

        <label for="extraDoc" class="form-label"><b>Dossier supplémentaire (optionnel) :</b></label>
        <input type="file" id="extraDoc" name="extraDoc" class="form-control" accept="application/pdf"> <br><br>

        <input type="hidden" name="statut" value="attente">
        <input type="hidden" name="idC" value="<?= $_SESSION['id'] ?>">
        <input type="hidden" name="date" value="<?= date("Y.m.d") ?>">
        <input type="hidden" name="action" value="ajouter">
        <input type="submit" value="valider">
    </div>
</form>


<script>
document.addEventListener("DOMContentLoaded", function() {
    let inputsFichier = document.querySelectorAll("input[type='file']");

    inputsFichier.forEach(input => {
        input.addEventListener("change", function() {
            let fichier = this.files[0];
            if (fichier) {
                let extension = fichier.name.split('.').pop().toLowerCase();
                if (extension !== "pdf") {
                    alert("❌ Seuls les fichiers PDF sont acceptés !");
                    this.value = ""; // Réinitialise le champ fichier
                }
            }
        });
    });
});
</script>
