<form method="POST" action="/register">
    @csrf
    <input type="email" name="email" placeholder="Email" required />
    <input type="text" name="nome" placeholder="Nome completo" required />
    <input type="password" name="password" placeholder="Senha" required />
    <input type="text" name="telefone" placeholder="Telefone" />
    <input type="text" name="endereco" placeholder="Endereço" />
    <button type="submit">Cadastrar</button>
</form>
