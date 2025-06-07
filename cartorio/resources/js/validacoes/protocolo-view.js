    // <!-- READONLY -->
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[type="date"]').forEach(input => {
            input.readOnly = true;
        });

        document.querySelectorAll('select').forEach(select => {
            select.style.pointerEvents = 'none'; // bloqueia clique

            select.tabIndex = -1;
            select.addEventListener('mousedown', e => e.preventDefault());
        });
    });

    // <!-- AUTENTICACAO -->
    function redirecionarParaAutenticacao() {
        var numero = document.getElementById('numero_protocolo').value;
        if (numero) {
            window.location.href = '/autenticacao/' + numero;
        } else {
            alert('Digite ou pesquise um número de protocolo antes de autenticar!');
        }
    }

    // <!-- VOLTAR -->
    document.getElementById('botao-voltar').addEventListener('click', function() {
        window.location.href = '{{ route('dashboard') }}';
    });


    // Função para preencher campos por id
    function setValueById(id, value) {
        const el = document.getElementById(id);
        if (el) el.value = value || '';
    }

    function setSelectById(id, value) {
        const el = document.getElementById(id);
        if (el) el.value = value || '';
    }

    function calcularPrevisao(dataAbertura) {
        if (!dataAbertura) return '';
        const data = new Date(dataAbertura);
        data.setDate(data.getDate() + 10);
        return data.toISOString().slice(0, 10); // YYYY-MM-DD para input type=date
    }

    function formatDateToInput(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        // Verifica se é uma data válida
        if (isNaN(date)) return '';
        return date.toISOString().slice(0, 10); // YYYY-MM-DD
    }

    document.getElementById('btn-pesquisar-protocolo').addEventListener('click', function() {
        const numero = document.getElementById('numero_protocolo').value;
        if (!numero) return alert('Digite o número do protocolo!');
        fetch(/protocolos/buscar/${numero})
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert(data.erro);
                    return;
                }
                setValueById('data_abertura', data.data_abertura);
                // Preencher campo previsão
                document.getElementById('previsao').value = calcularPrevisao(data.data_abertura);
                setValueById('numero_protocolo', data.numero_protocolo);
                setValueById('numero_registro', data.numero_registro);
                setValueById('numero_documento_protocolo', data.numero_documento);
                setValueById('data_documento_protocolo', data.data_documento);
                setValueById('data_retirada', formatDateToInput(data.data_retirada));
                setValueById('data_registro', formatDateToInput(data.data_registro));
                setValueById('data_cancelamento', data.data_cancelamento);
                setSelectById('id_grupo', data.id_grupo);
                setSelectById('id_natureza', data.id_natureza);
                setSelectById('id_especie', data.id_especie);
                if (data.apresentante) {
                    setSelectById('id_documento_apresentante', data.apresentante.id_documento);
                    setValueById('numero_documento_apresentante', data.apresentante.numero_documento);
                    setValueById('nome_apresentante', data.apresentante.nome);
                    setValueById('tipo_contato_apresentante', data.apresentante.tipo_contato);
                    setValueById('numero_contato_apresentante', data.apresentante.numero_contato);
                    setValueById('email_apresentante', data.apresentante.email);
                }
                // Partes (preenche todos)
                const partes = data.partes || [];
                const parteContainer = document.getElementById('container-partes');
                if (parteContainer && partes.length > 0) {
                    // Seleciona todas as linhas de parte já existentes
                    let linhas = parteContainer.querySelectorAll('.linha-parte');
                    // Adiciona linhas se necessário
                    while (linhas.length < partes.length) {
                        const novaLinha = linhas[0].cloneNode(true);
                        // Limpa valores
                        novaLinha.querySelectorAll('input, select').forEach(el => el.value = '');
                        parteContainer.appendChild(novaLinha);
                        linhas = parteContainer.querySelectorAll('.linha-parte');
                    }
                    // Remove linhas extras
                    while (linhas.length > partes.length) {
                        parteContainer.removeChild(linhas[linhas.length - 1]);
                        linhas = parteContainer.querySelectorAll('.linha-parte');
                    }
                    // Preenche cada linha
                    linhas.forEach((linha, i) => {
                        const select = linha.querySelector('select[name="id_tipo_parte[]"]');
                        const input = linha.querySelector('input[name="identificacao[]"]');
                        if (select) select.value = partes[i]?.id_tipo_parte || '';
                        if (input) input.value = partes[i]?.identificacao || '';
                    });

                    // chama a função de máscara logo após preencher
                    aplicarMascarasDeVisualizacao();
                }
            })
            .catch(error => {
                alert('Erro ao buscar protocolo. Veja o log do servidor.');
                // Log detalhado no console do navegador
                console.error('Erro ao buscar protocolo:', error);
                // Envia log para o backend
                fetch('/log-js-error', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        mensagem: error.message || error,
                        stack: error.stack || null,
                        protocolo: numero
                    })
                });
            });
    });

    document.getElementById('btn-retirar-protocolo').addEventListener('click', function() {
        const numeroProtocolo = document.getElementById('numero_protocolo').value;
        if (!numeroProtocolo) {
            alert('Número do protocolo não encontrado!');
            return;
        }
        // ...existing code...
        fetch(/protocolos/${numeroProtocolo}/atualizar-data-retirada, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            // ...existing code...
            .then(response => response.json())
            .then(data => {
                if (data.mensagem) {
                    alert(data.mensagem);
                    // Atualiza o campo data_retirada na tela
                    document.getElementById('data_retirada').value = new Date().toISOString().slice(0, 10);
                } else if (data.erro) {
                    alert(data.erro);
                }
            })
            .catch(error => {
                alert('Erro ao atualizar data de retirada.');
                console.error(error);
            });
    });

    function aplicarMascarasDeVisualizacao() {
        const doc = document.getElementById('numero_documento_apresentante');
        const tipo = document.getElementById('id_documento_apresentante');
        const contato = document.getElementById('numero_contato_apresentante');

        // Máscara telefone
        if (contato?.value) {
            let raw = contato.value.replace(/\D/g, '');
            let formatado = raw;
            if (raw.length > 6) {
                formatado = (${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)};
            } else if (raw.length > 2) {
                formatado = (${raw.slice(0, 2)}) ${raw.slice(2)};
            } else {
                formatado = (${raw};
            }
            contato.value = formatado;
        }

        // Máscara documento
        if (doc?.value && tipo?.value) {
            let valor = doc.value.replace(/\D/g, '');
            switch (tipo.value) {
                case '1': // RG
                    valor = valor.slice(0, 9);
                    if (valor.length > 7) {
                        doc.value = ${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5, 8)}-${valor.slice(8)};
                    } else if (valor.length > 4) {
                        doc.value = ${valor.slice(0, 2)}.${valor.slice(2, 5)}.${valor.slice(5)};
                    } else if (valor.length > 2) {
                        doc.value = ${valor.slice(0, 2)}.${valor.slice(2)};
                    } else {
                        doc.value = valor;
                    }
                    break;
                case '2': // CPF
                    valor = valor.slice(0, 11);
                    if (valor.length > 9) {
                        doc.value = ${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6, 9)}-${valor.slice(9)};
                    } else if (valor.length > 6) {
                        doc.value = ${valor.slice(0, 3)}.${valor.slice(3, 6)}.${valor.slice(6)};
                    } else if (valor.length > 3) {
                        doc.value = ${valor.slice(0, 3)}.${valor.slice(3)};
                    } else {
                        doc.value = valor;
                    }
                    break;
                case '3': // CNH
                    doc.value = valor.slice(0, 11);
                    break;
            }
        }
    }