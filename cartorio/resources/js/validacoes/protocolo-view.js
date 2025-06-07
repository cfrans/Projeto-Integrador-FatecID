document.addEventListener('DOMContentLoaded', () => {
    // Marcar todos os inputs tipo date como readonly
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.readOnly = true;
    });

    // Bloquear selects (somente visualização)
    document.querySelectorAll('select').forEach(select => {
        select.style.pointerEvents = 'none';
        select.tabIndex = -1;
        select.addEventListener('mousedown', e => e.preventDefault());
    });

    // Botão Voltar
    document.getElementById('botao-voltar')?.addEventListener('click', () => {
        window.location.href = '/dashboard';
    });

    // Botão Pesquisar Protocolo
    document.getElementById('btn-pesquisar-protocolo')?.addEventListener('click', () => {
        const numero = document.getElementById('numero_protocolo').value;
        if (!numero) return alert('Digite o número do protocolo!');

        fetch(`/protocolos/buscar/${numero}`)
            .then(res => res.json())
            .then(data => {
                if (data.erro) return alert(data.erro);

                preencherCampos(data);
                aplicarMascarasDeVisualizacao();
            })
            .catch(err => {
                alert('Erro ao buscar protocolo.');
                console.error('Erro:', err);
            });
    });

    // Botão Retirar
    document.getElementById('btn-retirar-protocolo')?.addEventListener('click', () => {
        const numero = document.getElementById('numero_protocolo').value;
        if (!numero) return alert('Número do protocolo não encontrado!');

        fetch(`/protocolos/${numero}/atualizar-data-retirada`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.mensagem) {
                alert(data.mensagem);
                document.getElementById('data_retirada').value = new Date().toISOString().slice(0, 10);
            } else if (data.erro) {
                alert(data.erro);
            }
        })
        .catch(err => {
            alert('Erro ao atualizar data de retirada.');
            console.error(err);
        });
    });

    function preencherCampos(data) {
        const set = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val || '';
        };

        set('data_abertura', data.data_abertura);
        set('numero_protocolo', data.numero_protocolo);
        set('numero_registro', data.numero_registro);
        set('numero_documento_protocolo', data.numero_documento);
        set('data_documento_protocolo', formatDate(data.data_documento));
        set('data_retirada', formatDate(data.data_retirada));
        set('data_registro', formatDate(data.data_registro));
        set('data_cancelamento', data.data_cancelamento);
        set('previsao', calcularPrevisao(data.data_abertura));

        set('id_grupo', data.id_grupo);
        set('id_natureza', data.id_natureza);
        set('id_especie', data.id_especie);

        if (data.apresentante) {
            set('id_documento_apresentante', data.apresentante.id_documento);
            set('numero_documento_apresentante', data.apresentante.numero_documento);
            set('nome_apresentante', data.apresentante.nome);
            set('tipo_contato_apresentante', data.apresentante.tipo_contato);
            set('numero_contato_apresentante', data.apresentante.numero_contato);
            set('email_apresentante', data.apresentante.email);
        }

        // Preencher partes
        if (data.partes?.length) {
            const container = document.getElementById('container-partes');
            const template = container.querySelector('.linha-parte');

            while (container.children.length > 1) {
                container.removeChild(container.lastElementChild);
            }

            data.partes.forEach((parte, i) => {
                const nova = i === 0 ? template : template.cloneNode(true);
                nova.querySelector('select[name="id_tipo_parte[]"]').value = parte.id_tipo_parte;
                nova.querySelector('input[name="identificacao[]"]').value = parte.identificacao;

                if (i > 0) container.appendChild(nova);
            });
        }
    }

    function calcularPrevisao(dataStr) {
        const data = new Date(dataStr);
        data.setDate(data.getDate() + 10);
        return data.toISOString().slice(0, 10);
    }

    function formatDate(str) {
        if (!str) return '';
        const data = new Date(str);
        return isNaN(data) ? '' : data.toISOString().slice(0, 10);
    }

    function aplicarMascarasDeVisualizacao() {
        const doc = document.getElementById('numero_documento_apresentante');
        const tipo = document.getElementById('id_documento_apresentante');
        const contato = document.getElementById('numero_contato_apresentante');

        if (contato?.value) {
            const raw = contato.value.replace(/\D/g, '').slice(0, 11);
            if (raw.length >= 10) {
                contato.value = `(${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)}`;
            } else if (raw.length > 2) {
                contato.value = `(${raw.slice(0, 2)}) ${raw.slice(2)}`;
            } else {
                contato.value = `(${raw}`;
            }
        }

        if (doc?.value && tipo?.value) {
            let val = doc.value.replace(/\D/g, '');
            switch (tipo.value) {
                case '1': // RG
                    val = val.slice(0, 9);
                    doc.value = val.replace(/^(\d{2})(\d{3})(\d{3})(\d)?$/, (_, a, b, c, d) =>
                        d ? `${a}.${b}.${c}-${d}` : `${a}.${b}.${c}`
                    );
                    break;
                case '2': // CPF
                    val = val.slice(0, 11);
                    doc.value = val.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4");
                    break;
                case '3': // CNH
                    doc.value = val.slice(0, 11);
                    break;
                case '4': // CNPJ (caso adicione no futuro)
                    val = val.slice(0, 14);
                    doc.value = val.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5");
                    break;
            }
        }
    }
});
