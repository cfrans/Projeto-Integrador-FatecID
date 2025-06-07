document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Assumindo que é o único <form> da página

    const campoValor = document.getElementById('valor'); 
    const campoValorPrevio = document.getElementById('autenticacao_valor_previo'); 
    const campoValorPago = document.getElementById('autenticacao_valor_pago');
    const campoTroco = document.getElementById('autenticacao_troco');

    const camposMoeda = [campoValor, campoValorPago, campoTroco];

    function aplicarMascaraMoeda(input) {
        let valor = input.value.replace(/\D/g, '');
        valor = (parseInt(valor, 10) / 100).toFixed(2);
        input.value = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function desformatarMoeda(valor) {
        return parseFloat(valor.replace(/\./g, '').replace(',', '.')) || 0;
    }

    campoValor?.addEventListener('input', () => {
        aplicarMascaraMoeda(campoValor);
        campoValorPrevio.value = campoValor.value;
        calcularTroco();
    });

    campoValorPago?.addEventListener('input', () => {
        aplicarMascaraMoeda(campoValorPago);
        calcularTroco();
    });

    function calcularTroco() {
        const valorPrevio = desformatarMoeda(campoValorPrevio.value);
        const valorPago = desformatarMoeda(campoValorPago.value);
        const troco = valorPago - valorPrevio;
        campoTroco.value = troco.toFixed(2).replace('.', ',');
    }

    // Envio com preview dos dados
    form?.addEventListener('submit', function (e) {
        e.preventDefault();

        // Remove as máscaras antes de criar o FormData
        if (campoValor) campoValor.value = desformatarMoeda(campoValor.value);
        if (campoValorPago) campoValorPago.value = desformatarMoeda(campoValorPago.value);
        if (campoTroco) campoTroco.value = desformatarMoeda(campoTroco.value);

        const formData = new FormData(form);

        // Mostrar dados via alert
        let debugSaida = '';
        for (const [chave, valor] of formData.entries()) {
            debugSaida += `${chave}: ${valor}\n`;
        }

        console.log('submit interceptado');
        alert('Dados que serão enviados:\n\n' + debugSaida);

        // Se quiser enviar após confirmação
        form.submit(); // Aqui faz o envio real depois do preview
    });

    // Ativa/desativa campos de cheque
    const formaPagamento = document.getElementById('id_forma_pagamento');
    const camposCheque = [
        document.getElementById('id_banco'),
        document.getElementById('autenticacao_conta'),
        document.getElementById('autenticacao_agencia'),
        document.getElementById('autenticacao_cheque')
    ];

    function liberaCamposCheque() {
        const isCheque = formaPagamento.value === '4';
        camposCheque.forEach(campo => campo.disabled = !isCheque);
    }

    liberaCamposCheque();
    formaPagamento?.addEventListener('change', liberaCamposCheque);
});