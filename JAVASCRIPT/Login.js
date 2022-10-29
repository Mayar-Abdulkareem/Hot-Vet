
function register()
{
    document.getElementById('register').style.visibility = "visible";
    document.getElementById('login').style.visibility="hidden";
    document.getElementById('registerButton').style.background="#099aac";
    document.getElementById('loginButton').style.background="transparent";
}
function login()
{
    document.getElementById('login').style.visibility="visible";
    document.getElementById('register').style.visibility="hidden";
    document.getElementById('loginButton').style.background="#099aac";
    document.getElementById('registerButton').style.background="transparent";
}
