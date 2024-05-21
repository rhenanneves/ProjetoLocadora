const clienteForm = document.querySelector('.form-section.cliente');
const funcionarioForm = document.querySelector('.form-section.funcionario');
const loginForm = document.getElementById('login-form');

// Adiciona evento de clique nos botões de alternar entre cliente e funcionário
document.getElementById('btn-cliente').addEventListener('click', () => {
    clienteForm.classList.add('active');
    funcionarioForm.classList.remove('active');
    loginForm.style.transform = 'translateX(0%)'; // Move para a posição inicial
});

document.getElementById('btn-funcionario').addEventListener('click', () => {
    funcionarioForm.classList.add('active');
    clienteForm.classList.remove('active');
    loginForm.style.transform = 'translateX(-50%)'; // Move para a posição do formulário do funcionário
});
