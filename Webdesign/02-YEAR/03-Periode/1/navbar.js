let nav = "<ul>" +
    "<li><a href='index.html'>Home</a></li>" +
    "<li><a href='projecten.html'>Projecten</a></li>" +
    "<li><a href='services.html'>Services</a></li>" +
    "<li><a href='profiel.html'>Profiel</a></li>" +
    "<li><a href='inloggen.html'>Inloggen</a></li>" +
    "</ul>";

let hamburger = `<input id='hamburger' type='checkbox' />
    <label class='hamburger_btn' for='hamburger'>
        <span></span>
    </label>
    
    <ul class='hamburger_menu'>
        <li class='menu_item'><a href='index.html'><img src="logo.png" alt="logo" width="50px"></a></li>
        <li class='menu_item'><a href='projecten.html'>Projecten</a></li>
        <li class='menu_item'><a href='services.html'>Services</a></li>
        <li class='menu_item'><a href='profiel.html'>Profiel</a></li>
        <li class='menu_item'><a href='inloggen.html'>Inloggen</a></li>
    </ul>
    `;

document.getElementById("navbar").innerHTML = nav;
document.getElementById("hamburgernav").innerHTML = hamburger;