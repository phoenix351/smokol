<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");

* {
    margin: 0%;
    padding: 0%;
    box-sizing: border-box;
}

body {
    font-family: "Roboto";
}

a {
    text-decoration: none;
    color: #1a73e8;
    display: block;
    font-size: 14px;
}

.container {
    max-width: 450px;
    border: 1px solid rgb(228, 228, 228);
    margin: auto;
    margin-top: 4rem;
    border-radius: 10px;
    padding: 2rem;
    height: 500px;
    /* text-align: center; */
}

.top-content {
    text-align: center;
}

img {
    width: 80px;
    margin: 10px 0;
}

h2 {
    font-size: 20px;
    font-weight: 100;
    margin-bottom: 10px;
}

.heading {
    margin-bottom: 30px;
}

input[type="email"],
input[type="password"] {
    display: block;
    border: 1px solid rgb(228, 228, 228);
    font-size: 16px;
    width: 100%;
    height: 55px;
    padding: 0 15px;
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
    background-color: transparent;
    outline: none;
    border-radius: 5px;
    position: relative;
}


.inputs {
    position: relative;
}

.input-label {
    position: absolute;
    top: 15px;
    font-size: 1.1rem;
    left: 14px;
    color: rgb(122, 122, 122);
    font-weight: 100;
    transition: 0.1s ease;
    background-color: white;
    padding: 0 5px;
}

input[type="email"]:focus~.input-label {
    top: -7px;
    color: #1864c9;
    font-size: 13px;
    background-color: rgb(255, 255, 255);
    z-index: 2;
}

input[type="email"]:not(:placeholder-shown):not(:focus)~.input-label,
input[type="password"]:not(:placeholder-shown):not(:focus)~.input-label {
    top: -7px;
    color: #1864c9;
    font-size: 13px;
    background-color: rgb(255, 255, 255);
    z-index: 2;
}


input[type="email"]:target~.input-label {
    top: -7px;
    color: #1864c9;
    font-size: 13px;
    background-color: rgb(255, 255, 255);
    z-index: 2;
}

input::placeholder {
    visibility: hidden;
}




input[type="password"]:focus~.input-label {
    top: -7px;
    color: #1864c9;
    font-size: 13px;
    background-color: rgb(255, 255, 255);
    z-index: 2;
}

input[type="password"]:target~.input-label {
    top: -7px;
    color: #1864c9;
    font-size: 13px;
    background-color: rgb(255, 255, 255);
    z-index: 2;
}

.input:focus {
    border: 2px solid #1a73e8;
}

.link-btn {
    margin-bottom: 2rem;
}

.color {
    color: rgb(90, 90, 90);
    font-size: 14px;
    margin-bottom: 5px;
}

.btn-group {
    display: flex;
    justify-content: space-between;
}

.create-btn {
    border: none;
    background-color: transparent;
    color: #1a73e8;
    font-weight: bold;
    cursor: pointer;
    height: 35px;
    padding: 10px 5px;
}

.next-btn {
    background-color: #1a73e8;
    color: white;
    border: none;
    height: 38px;
    padding: 0 25px;
    border-radius: 5px;
    cursor: pointer;
}

.create-btn:hover {
    background-color: #e8f2ff6e;
    /* transition: 0.2s all ease-in; */
}

.next-btn:hover {
    background-color: #1864c9;
}
</style>
<div class="container">
    <div class="top-content">
        <h1 style="margin-bottom:30px;color:#3219d4">Smokol</h1>

        <h2 style="margin-bottom:30px;">Sign in</h2>
        <?= view('Myth\Auth\Views\_message_block') ?>

    </div>
    <div class="inputs">
        <form action="<?= url_to('login') ?>" method="post">
            <?= csrf_field() ?>
            <input type="email" name="login" id="email" class="input" placeholder="Email or username">
            <label for="email" class="input-label">Email or phone</label>
            <div class="invalid-feedback">
                <?= session('errors.login') ?>
            </div>
    </div>
    <div class="inputs">
        <input type="password" placeholder="Password" name="password" id="password" class="input">
        <label for="password" class="input-label">Password</label>
        <div class="invalid-feedback">
            <?= session('errors.login') ?>
        </div>
    </div>
    <a href="" class="link-btn">Forgot Email?</a>
    <p class="color">Not your computer? Use Guest mode to sign in privately.</p>
    <a href="" class="link-btn">Learn More</a>
    <div class="btn-group">
        <button class="create-btn">Create account</button>
        <input type="submit" class="next-btn" value="Login" />
        </form>

    </div>
</div>