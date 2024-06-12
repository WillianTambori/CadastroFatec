<?php

echo $_POST['param[1]'];
?>
<form action="./TestePost.php" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
                    <!-- <input type="hidden" name="param[0]" value=<> -->
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="param[1]">
                    <button class="btn btn-outline-success" type="submit" id="inputGroupFileAddon04">Enviar documento</button>
                </div>
        </form>