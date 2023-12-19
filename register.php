<form action="functions.php?op=register" method="post">
    <div>
        <label for="name">name</label>
        <input type="text" id='name' name='name'>
    </div>
    <div>
        <label for="phone">phone</label>
        <input type="tel" id='phone' name='phone'>
    </div>
    <div>
        <label for="birthday">birthday</label>
        <input type="date" id='birthday' name='birthday'>
    </div>
    <div>
        <label for="email">email</label>
        <input type="email" id='email' name='email'>
    </div>
    <div>
        <label for="password">paaword</label>
        <input type="password" id='password' name='password'>
    </div>
    <div>
        <label for="confirm-password">confirm paaword</label>
        <input type="password" id='confirm-password' name='confirm-password'>
    </div>
    <button type='submit'>register</button>
</form>