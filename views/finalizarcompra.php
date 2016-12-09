<form method="POST" class="form-horizontal" id="form">
    <div class="container">
        <div class="row">
            <h1 class="text-success text-center">Finalizar compra</h1>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Informações do Usuário</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nome:</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">E-mail:</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Senha:</label>
                            <div class="col-sm-10">
                                <input type="password" name="senha" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Fone:</label>
                            <div class="col-sm-10">
                                <input type="text" name="telefone" class="form-control" id="telefone">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Informações de Endereço</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">CEP:</label>
                            <div class="col-sm-5">
                                <input type="text" name="endereco[cep]" class="form-control" id="cep">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Rua:</label>
                            <div class="col-sm-10">
                                <input type="text" name="endereco[rua]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nº:</label>
                            <div class="col-sm-4">
                                <input type="text" name="endereco[num]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Comp.:</label>
                            <div class="col-sm-10">
                                <input type="text" name="endereco[comp]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Bairro:</label>
                            <div class="col-sm-10">
                                <input type="text" name="endereco[bairro]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Cidade:</label>
                            <div class="col-sm-10">
                                <input type="text" name="endereco[cidade]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Estado:</label>
                            <div class="col-sm-10">
                                <input type="text" name="endereco[estado]" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Resumo da Compra</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Total:</label>
                            <div class="col-sm-10">
                                <?php echo $total; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Informações de Pagamento</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Forma Pgto:</label>
                            <div class="col-sm-10">
                                <select name="pg_form" id="pg_form" class="form-control" onchange="selectPg()">
                                    <option value="">Selecione...</option>
                                    <option value="CREDIT_CARD">Cartão de Crédito</option>
                                    <option value="BOLETO">Boleto</option>
                                    <option value="BALANCE">Saldo PagSeguro</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="cc" style="display: none">
                            <div class="col-sm-12" id="bandeiras"></div>
                        </div>
                        <div class="form-group" id="cardinfo" style="display: none">
                            Parcelamento:
                            Titular:
                            CPF:
                            numero do cartão
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">            
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button class="btn btn-lg btn-success btn-block">Finalizar Pedido</button>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    <input type="hidden" name="bandeira" id="bandeira" />
    <input type="hidden" name="ctoken" id="ctoken" />
    <input type="hidden" name="shash" id="shash" />
    <input type="hidden" name="sessionId" value="<?php echo $sessionId; ?>" />
</form>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript">
    var sessionId = '<?php echo $sessionId; ?>';
    var valor = '<?php echo $total; ?>';
    var formOk = false;
</script>
<script type="text/javascript" src="/assets/js/ckt.js"></script>