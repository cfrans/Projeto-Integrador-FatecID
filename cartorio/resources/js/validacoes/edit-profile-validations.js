// resources/js/validacoes/shared-validations.js

document.addEventListener('DOMContentLoaded', () => {
    const campos = {
        nome: document.getElementById('nome'),
        email: document.getElementById('email'),
        telefone: document.getElementById('telefone'),
        endereco: document.getElementById('endereco'),
        setor: document.getElementById('setor'),
    };

    function showMessage(message, targetInput) {
        if (!targetInput) return;
        const aviso = document.createElement('div');
        aviso.textContent = message;
        aviso.className = 'text-red-500 text-sm mt-1 animate-fade-out';
        aviso.style.position = 'absolute';

        const wrapper = targetInput.closest('div');
        if (wrapper?.querySelector('.error-message')) return;

        aviso.classList.add('error-message');
        wrapper.appendChild(aviso);
        setTimeout(() => aviso.remove(), 3000);
    }

    function limitLength(input, max = 255) {
        if (!input) return;
        if (input.value.length > max) {
            input.value = input.value.slice(0, max);
            showMessage(`Máximo de ${max} caracteres permitido.`, input);
        }
    }

    if (campos.nome) {
        campos.nome.addEventListener('input', () => {
            const valor = campos.nome.value;
            campos.nome.value = valor.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
            limitLength(campos.nome);
            if (/[^A-Za-zÀ-ÿ\s]/.test(valor)) {
                showMessage('Apenas letras são permitidas no nome.', campos.nome);
            }
        });
    }

    if (campos.email) {
        campos.email.addEventListener('input', () => {
            campos.email.value = campos.email.value.toLowerCase();
            limitLength(campos.email);
        });

        campos.email.addEventListener('blur', () => {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regex.test(campos.email.value)) {
                showMessage('Digite um e-mail válido.', campos.email);
            }
        });
    }

    if (campos.telefone) {
        campos.telefone.addEventListener('input', () => {
            let raw = campos.telefone.value.replace(/\D/g, '').slice(0, 11);
            let formatado = raw;
            if (raw.length > 6) {
                formatado = `(${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)}`;
            } else if (raw.length > 2) {
                formatado = `(${raw.slice(0, 2)}) ${raw.slice(2)}`;
            } else if (raw.length > 0) {
                formatado = `(${raw}`;
            }
            campos.telefone.value = formatado;
        });
    }

    if (campos.endereco) {
        campos.endereco.addEventListener('input', () => limitLength(campos.endereco));
    }

    if (campos.setor) {
        campos.setor.addEventListener('change', () => limitLength(campos.setor));
    }

    // Aplica a máscara inicial no telefone carregado
    if (campos.telefone) {
        let valor = campos.telefone.value.replace(/\D/g, '').slice(0, 11);
        if (valor) {
            let formatado = valor;
            if (valor.length > 6) {
                formatado = `(${valor.slice(0, 2)}) ${valor.slice(2, 7)}-${valor.slice(7)}`;
            } else if (valor.length > 2) {
                formatado = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
            } else {
                formatado = `(${valor}`;
            }
            campos.telefone.value = formatado;
        }
    }

});
