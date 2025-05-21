<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Senha" required />
    <button type="submit">Entrar</button>
</form>
