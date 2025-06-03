document.addEventListener('DOMContentLoaded', () => {
    const usuario = document.getElementById('usuario');
    const nome = document.getElementById('nome');
    const email = document.getElementById('email');
    const telefone = document.getElementById('telefone');
    const endereco = document.getElementById('endereco');
    const setor = document.getElementById('setor');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

    const MAX_LENGTH = 255;

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

    function limitLength(input) {
        if (input.value.length > MAX_LENGTH) {
            input.value = input.value.slice(0, MAX_LENGTH);
            showMessage('Máximo de 255 caracteres permitido.', input);
        }
    }

    usuario.addEventListener('input', () => {
        const valorAntigo = usuario.value;
        usuario.value = valorAntigo.replace(/\s/g, '');
        limitLength(usuario);
        if (/\s/.test(valorAntigo)) {
            showMessage('Espaços não são permitidos no usuário.', usuario);
        }
    });

    nome.addEventListener('input', () => {
        const valorAntigo = nome.value;
        nome.value = valorAntigo.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
        limitLength(nome);
        if (/[^A-Za-zÀ-ÿ\s]/.test(valorAntigo)) {
            showMessage('Apenas letras são permitidas no nome.', nome);
        }
    });

    email.addEventListener('input', () => {
        email.value = email.value.toLowerCase();
        limitLength(email);
    });

    email.addEventListener('blur', () => {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(email.value)) {
            showMessage('Digite um e-mail válido.', email);
        }
    });

    telefone.addEventListener('input', () => {
        let raw = telefone.value.replace(/\D/g, '').slice(0, 11);
        let formatado = raw;
        if (raw.length > 6) {
            formatado = `(${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)}`;
        } else if (raw.length > 2) {
            formatado = `(${raw.slice(0, 2)}) ${raw.slice(2)}`;
        } else if (raw.length > 0) {
            formatado = `(${raw}`;
        }
        telefone.value = formatado;
    });

    endereco.addEventListener('input', () => {
        limitLength(endereco);
    });

    setor.addEventListener('input', () => {
        limitLength(setor);
    });

    password.addEventListener('input', () => {
        const val = password.value;
        const strength = document.getElementById('password-strength');
        if (!strength) return;

        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        let text = 'Fraca', color = 'text-red-500';
        if (score >= 3) [text, color] = ['Média', 'text-yellow-500'];
        if (score === 4) [text, color] = ['Forte', 'text-green-500'];

        strength.textContent = `Força da senha: ${text}`;
        strength.className = color + ' text-sm mt-1';

        if (val.length < 8) {
            showMessage('Senha precisa de no mínimo 8 caracteres.', password);
        }
    });

    confirmPassword.addEventListener('input', () => {
        const matchIndicator = document.getElementById('password-match');
        if (!matchIndicator) return;

        if (confirmPassword.value === password.value && password.value.length > 0) {
            matchIndicator.textContent = 'As senhas conferem';
            matchIndicator.className = 'text-green-600 text-sm mt-1';
        } else {
            matchIndicator.textContent = '';
        }
    });

    const botaoCadastrar = document.getElementById('botao-cadastrar');
    const formulario = document.querySelector('form');

    botaoCadastrar.addEventListener('click', (event) => {
        let valido = true;

        // Valida usuário
        if (usuario.value.length > 255 || /\s/.test(usuario.value)) {
            showMessage('Usuário inválido (máx. 255 caracteres e sem espaços)', usuario);
            valido = false;
        }

        // Valida nome
        if (nome.value.length > 255 || /[^A-Za-zÀ-ÿ\s]/.test(nome.value)) {
            showMessage('Nome inválido (somente letras, até 255 caracteres)', nome);
            valido = false;
        }

        // Valida email
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.length > 255 || !regexEmail.test(email.value)) {
            showMessage('E-mail inválido (máx. 255 caracteres)', email);
            valido = false;
        } else {
            email.value = email.value.toLowerCase(); // força lowercase
        }

        // Valida telefone (mantém como está)
        // Não tem limite no banco, só mascara e número

        // Valida endereço
        if (endereco.value.length > 255) {
            showMessage('Endereço muito longo (máx. 255 caracteres)', endereco);
            valido = false;
        }

        // Valida setor
        if (setor.value.length > 255) {
            showMessage('Setor inválido (máx. 255 caracteres)', setor);
            valido = false;
        }

        // Valida senha
        if (password.value.length < 8) {
            showMessage('A senha deve ter no mínimo 8 caracteres.', password);
            valido = false;
        }

        // Confirmação de senha
        if (confirmPassword.value !== password.value) {
            showMessage('As senhas não conferem.', confirmPassword);
            valido = false;
        }

        if (!valido) {
            event.preventDefault(); // Impede o envio do formulário
        }
    });


});

