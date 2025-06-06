document.addEventListener('DOMContentLoaded', () => {
    const numeroTitulo = document.getElementById('numero_documento_protocolo'); // Nº Documento / Título
    const tipoDocumentoSelect = document.getElementById('id_documento'); // Dropdown RG/CPF/CNH/CNPJ
    const numeroDocumentoApresentante = document.getElementById('numero_documento_apresentante'); // CAMPO CORRETO
    const email = document.getElementById('email');

    function showMessage(message, targetInput) {
        const aviso = document.createElement('div');
        aviso.textContent = message;
        aviso.className = 'text-red-500 text-sm mt-1 animate-fade-out';
        aviso.style.position = 'absolute';

        const wrapper = targetInput.closest('div');
        if (wrapper.querySelector('.error-message')) return;

        aviso.classList.add('error-message');
        wrapper.appendChild(aviso);

        setTimeout(() => aviso.remove(), 3000);
    }

    // Campo Nº Documento / Título (só número, sem pontos ou traços)
    numeroTitulo?.addEventListener('input', () => {
        numeroTitulo.value = numeroTitulo.value.replace(/\D/g, '').slice(0, 9);
    });

    // Aplica máscara dinâmica no campo do apresentante
    function aplicarMascaraApresentante() {
        if (!numeroDocumentoApresentante) return;

        let valor = numeroDocumentoApresentante.value.replace(/\D/g, '');

        switch (tipoDocumentoSelect.value) {
            case '1': // RG com máscara 99.999.999-9
                valor = valor.slice(0, 9);
                if (valor.length > 7) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5, 8)}-${valor.slice(8)}`;
                } else if (valor.length > 4) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5)}`;
                } else if (valor.length > 2) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2)}`;
                } else {
                    numeroDocumentoApresentante.value = valor;
                }
                break;


            case '2': // CPF
                valor = valor.slice(0, 11);
                if (valor.length > 9) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6, 9)}-${valor.slice(9)}`;
                } else if (valor.length > 6) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6)}`;
                } else if (valor.length > 3) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 3)}.${valor.slice(3)}`;
                } else {
                    numeroDocumentoApresentante.value = valor;
                }
                break;

            case '3': // CNH (só número)
                valor = valor.slice(0, 11);
                numeroDocumentoApresentante.value = valor;
                break;

            case '4': // CNPJ
                valor = valor.slice(0, 14);
                if (valor.length > 12) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5, 8)}/${valor.slice(8, 12)}-${valor.slice(12)}`;
                } else if (valor.length > 8) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5, 8)}/${valor.slice(8)}`;
                } else if (valor.length > 5) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5)}`;
                } else if (valor.length > 2) {
                    numeroDocumentoApresentante.value = `${valor.slice(0, 2)}.${valor.slice(2)}`;
                } else {
                    numeroDocumentoApresentante.value = valor;
                }
                break;
        }
    }

    tipoDocumentoSelect?.addEventListener('change', aplicarMascaraApresentante);
    numeroDocumentoApresentante?.addEventListener('input', aplicarMascaraApresentante);

    // Email
    email?.addEventListener('input', () => {
        email.value = email.value.toLowerCase();
    });

    email?.addEventListener('blur', () => {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(email.value)) {
            showMessage('Digite um e-mail válido.', email);
        }
    });

    // Máscara de telefone no campo número de contato
    const numeroContato = document.getElementById('numero_contato');

    if (numeroContato) {
        numeroContato.addEventListener('input', () => {
            let raw = numeroContato.value.replace(/\D/g, '').slice(0, 11);

            let formatado = raw;
            if (raw.length > 6) {
                formatado = `(${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)}`;
            } else if (raw.length > 2) {
                formatado = `(${raw.slice(0, 2)}) ${raw.slice(2)}`;
            } else if (raw.length > 0) {
                formatado = `(${raw}`;
            }

            numeroContato.value = formatado;
        });
    }

    // Força o número_documento a ser só dígitos (remove pontos, traços, letras etc.)
    const numeroDocumento = document.getElementById('numero_documento');
    if (numeroDocumento) {
        numeroDocumento.value = numeroDocumento.value.replace(/\D/g, '');
    }

    form.addEventListener('submit', function () {
        // Limpar máscara do documento do apresentante
        if (numeroDocumentoApresentante) {
            numeroDocumentoApresentante.value = numeroDocumentoApresentante.value.replace(/\D/g, '');
        }

        // Limpar máscara do telefone
        if (numeroContato) {
            numeroContato.value = numeroContato.value.replace(/\D/g, '');
        }

        // Também limpar o número do título, se ainda não estiver limpo
        if (numeroTitulo) {
            numeroTitulo.value = numeroTitulo.value.replace(/\D/g, '');
        }
    });



});
