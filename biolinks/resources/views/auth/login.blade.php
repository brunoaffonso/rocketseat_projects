<div>
    <h1>Login</h1>

    <form action="/login" method="post">
        @csrf

        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Senha">

        <button>Login</button>
    </form>
</div>
