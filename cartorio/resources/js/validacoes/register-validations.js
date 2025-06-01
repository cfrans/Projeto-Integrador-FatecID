// document.addEventListener('DOMContentLoaded', () => {
//     const usuario = document.getElementById('usuario');
//     const nome = document.getElementById('nome');
//     const email = document.getElementById('email');
//     const telefone = document.getElementById('telefone');
//     const password = document.getElementById('password');
//     const confirmPassword = document.getElementById('password_confirmation');

//     function showMessage(message, targetInput) {
//         const aviso = document.createElement('div');
//         aviso.textContent = message;
//         aviso.className = 'text-red-500 text-sm mt-1 animate-fade-out';
//         aviso.style.position = 'absolute';

//         const wrapper = targetInput.closest('div');
//         if (wrapper.querySelector('.error-message')) return;

//         aviso.classList.add('error-message');
//         wrapper.appendChild(aviso);

//         setTimeout(() => aviso.remove(), 3000);
//     }

//     // Mascara e aviso: Usuário (sem espaços)
//     usuario.addEventListener('input', () => {
//         const valorAntigo = usuario.value;
//         usuario.value = valorAntigo.replace(/\s/g, '');
//         if (/\s/.test(valorAntigo)) {
//             showMessage('Espaços não são permitidos no usuário.', usuario);
//         }
//     });

//     // Nome: só letras e acentos
//     nome.addEventListener('input', () => {
//         const valorAntigo = nome.value;
//         nome.value = valorAntigo.replace(/[^A-Za-zÀ-ÿ\s]/g, '');
//         if (/[^A-Za-zÀ-ÿ\s]/.test(valorAntigo)) {
//             showMessage('Apenas letras são permitidas no nome.', nome);
//         }
//     });

//     // E-mail: valida ao sair do campo
//     email.addEventListener('blur', () => {
//         const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         if (!regex.test(email.value)) {
//             showMessage('Digite um e-mail válido.', email);
//         }
//     });

//     // Telefone: mascara com edição total
//     telefone.addEventListener('input', () => {
//         let cursor = telefone.selectionStart;
//         let raw = telefone.value.replace(/\D/g, '').slice(0, 11);

//         let formatado = raw;
//         if (raw.length > 6) {
//             formatado = `(${raw.slice(0, 2)}) ${raw.slice(2, 7)}-${raw.slice(7)}`;
//         } else if (raw.length > 2) {
//             formatado = `(${raw.slice(0, 2)}) ${raw.slice(2)}`;
//         } else if (raw.length > 0) {
//             formatado = `(${raw}`;
//         }

//         telefone.value = formatado;
//     });

//     // Força da senha
//     password.addEventListener('input', () => {
//         const val = password.value;
//         const strength = document.getElementById('password-strength');
//         if (!strength) return;

//         let score = 0;
//         if (val.length >= 8) score++;
//         if (/[A-Z]/.test(val)) score++;
//         if (/[0-9]/.test(val)) score++;
//         if (/[^A-Za-z0-9]/.test(val)) score++;

//         let text = 'Fraca', color = 'text-red-500';
//         if (score >= 3) [text, color] = ['Média', 'text-yellow-500'];
//         if (score === 4) [text, color] = ['Forte', 'text-green-500'];

//         strength.textContent = `Força da senha: ${text}`;
//         strength.className = color + ' text-sm mt-1';
//     });

//     // Senhas conferem
//     confirmPassword.addEventListener('input', () => {
//         const matchIndicator = document.getElementById('password-match');
//         if (!matchIndicator) return;

//         if (confirmPassword.value === password.value && password.value.length > 0) {
//             matchIndicator.textContent = 'As senhas conferem';
//             matchIndicator.className = 'text-green-600 text-sm mt-1';
//         } else {
//             matchIndicator.textContent = '';
//         }
//     });
// });
