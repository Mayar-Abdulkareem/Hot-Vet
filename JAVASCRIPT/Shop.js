function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function changeprice(item_id, value, price) {
    document.getElementById(item_id + 'price').innerHTML = 'Price: ' + price * value + '$';
}

function changecolor(id, color) {
    document.getElementById(id+'color').value = color;
}