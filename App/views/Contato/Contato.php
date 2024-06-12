<div class="scrollable-box" style="max-height: 70vh; padding: 10px; margin: auto; overflow-y: auto;">
<a class="btn btn-outline-success"  href="./index.php?class=Contato&acao=ListarContato&pdf=1">PDF</a>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Escola</th>
            <th scope="col">Whatszaap</th>
            <th scope="col">Contato</th>
            <th scope="col">Cadastro</th>
            <th scope="col">Curso</th>
            
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($contatos as $ctt){?>
                <tr>
                    <?php foreach($ctt as $ct){ ?>
                    <td>
                        <?= $ct?>
                    </td>
                    <?php } ?>
                </tr>
            
            <?php } ?>
        </tbody>
    </table>
</div>
