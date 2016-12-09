window.onload = function(){
    PagSeguroDirectPayment.setSessionId(sessionId);
}

function selectPg(){
    var pgCode = document.getElementById("pg_form").value;
    if (pgCode === 'CREDIT_CARD') {
        PagSeguroDirectPayment.getPaymentMethods({
            amount:valor,
            success:function(json){
                var cartoes = json.paymentMethods.CREDIT_CARD.options;
                var cDisponiveis = ['VISA','MASTERCARD','AMEX','HIPERCARD'];
                var html = '';
                
                for (var i in cDisponiveis) {
                    if (cartoes[cDisponiveis[i]].status == "AVAILABLE") {
                        html += '<img src="https://" />';
                    }
                }
                
                document.getElementById("bandeiras").innerHTML = html;
                document.getElementById("cc").style.display = "block";
            },
            error:function(e){console.log(e)}
        });
    }
}