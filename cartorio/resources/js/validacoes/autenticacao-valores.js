document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Assumindo que é o único <form> da página

    // Certifique-se que estes IDs existam apenas na tela de autenticação
    const campoValorPrincipal = document.getElementById('valor');
    const campoValorPrevio = document.getElementById('autenticacao_valor_previo'); 
    const campoValorPago = document.getElementById('autenticacao_valor_pago');
    const campoTroco = document.getElementById('autenticacao_troco');

    // Funções de máscara de moeda
    function aplicarMascaraMoeda(input) {
        let valor = input.value.replace(/\D/g, ''); // Remove tudo que não é dígito
        if (valor === '') { // Se o campo ficar vazio, define como 0
            input.value = '0,00';
            return;
        }
        valor = (parseInt(valor, 10) / 100).toFixed(2); // Divide por 100 e formata para 2 casas decimais
        // Formata para BRL: troca ponto por vírgula e adiciona separador de milhares
        input.value = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function desformatarMoeda(valor) {
        // Remove pontos de milhares e troca vírgula por ponto para converter para float
        return parseFloat(valor.replace(/\./g, '').replace(',', '.')) || 0;
    }

    // --- Aplicar máscaras nos campos de VALOR DO ANDAMENTO ---
    // Seleciona todos os campos de valor que possuem o atributo data-moeda (tanto os pré-existentes quanto os do template)
    document.querySelectorAll('[data-moeda]').forEach(function(campo) {
        // Aplica a máscara inicial apenas se o campo não for readonly
        if (!campo.readOnly) {
            aplicarMascaraMoeda(campo);
            campo.addEventListener('input', function() {
                aplicarMascaraMoeda(this);
            });
        }
    });

    // --- Lógica de Autenticação (manter se ainda for usada em alguma página) ---
    // Atribui event listeners apenas se os campos de autenticação existirem
    if (campoValorPrincipal) { // Verifica se pelo menos o campo principal existe
        campoValorPrincipal.addEventListener('input', () => {
            aplicarMascaraMoeda(campoValorPrincipal);
            if (campoValorPrevio) campoValorPrevio.value = campoValorPrincipal.value; // Atualiza o valor prévio
            calcularTroco();
        });
    }

    if (campoValorPago) {
        campoValorPago.addEventListener('input', () => {
            aplicarMascaraMoeda(campoValorPago);
            calcularTroco();
        });
    }

    function calcularTroco() {
        if (campoValorPrevio && campoValorPago && campoTroco) {
            const valorPrevio = desformatarMoeda(campoValorPrevio.value);
            const valorPago = desformatarMoeda(campoValorPago.value);
            const troco = valorPago - valorPrevio;
            campoTroco.value = troco.toFixed(2).replace('.', ',');
        }
    }

    // --- Envio do Formulário (ajustado para múltiplos campos de valor) ---
    form?.addEventListener('submit', function (e) {
        e.preventDefault();

        // Desformata TODOS os campos de valor com data-moeda antes de enviar
        document.querySelectorAll('[data-moeda]').forEach(function(campo) {
            if (!campo.readOnly) { // Desformata apenas campos editáveis
                campo.value = desformatarMoeda(campo.value);
            }
        });

        // Desformata os campos de autenticação específicos se eles existirem
        if (campoValorPrincipal) campoValorPrincipal.value = desformatarMoeda(campoValorPrincipal.value);
        if (campoValorPago) campoValorPago.value = desformatarMoeda(campoValorPago.value);
        if (campoTroco) campoTroco.value = desformatarMoeda(campoTroco.value);


        const formData = new FormData(form);

        let debugSaida = '';
        for (const [chave, valor] of formData.entries()) {
            debugSaida += `${chave}: ${valor}\n`;
        }

        form.submit(); // Envio real do formulário
    });

    // --- Lógica de Ativar/Desativar campos de Cheque ---
    const formaPagamento = document.getElementById('id_forma_pagamento');
    const camposCheque = [
        document.getElementById('id_banco'),
        document.getElementById('autenticacao_conta'),
        document.getElementById('autenticacao_agencia'),
        document.getElementById('autenticacao_cheque')
    ];

    function liberaCamposCheque() {
        if (formaPagamento) {
            const isCheque = formaPagamento.value === '4';
            camposCheque.forEach(campo => {
                if (campo) campo.disabled = !isCheque;
            });
        }
    }

    liberaCamposCheque(); // Chama ao carregar a página
    if (formaPagamento) {
        formaPagamento.addEventListener('change', liberaCamposCheque);
    }
});