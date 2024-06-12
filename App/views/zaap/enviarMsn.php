<?php
if($resposta->success){
    echo 'ok';
}else{
    echo 'fail';
};
?>
<form action="index.php?class=Zaap&acao=enviar" method="post">

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">numero</label>
        <input type="tel" class="form-control" id="exampleFormControlInput1" name="param[0]" placeholder="telefone">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">mensagem</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="param[1]"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h2>foto</h2>

<form action="index.php?class=Zaap&acao=midia" method="post">

    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">numero</label>
        <input type="tel" class="form-control" id="exampleFormControlInput1" name="param[0]" placeholder="telefone">
    </div>
    <div class="mb-3">
    <label for="formFile" class="form-label">arquivo</label>
  <input class="form-control" type="file" name="param[1]" accept="image/*" id="formFile">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>