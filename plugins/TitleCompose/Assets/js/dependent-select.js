function getClientProductsJson() {

    $clientsObject = {
        "California": {
            "Monterey": ["Salinas", "Gonzales"],
            "Alameda": ["Berkeley"]
        },
        "Oregon": {
            "Douglas": ["Roseburg", "Winston"],
        }
    };
    return $clientsObject;
}

function initClient(){
    clientSel = document.getElementById("form-client_id");
    for (var client in clientsObject) {
        clientSel.options[clientSel.options.length] = new Option(client, client);
    }
    console.log("Hola");
}

function clientChange(json_productos){
    console.log(json_productos);
    var productSel = document.getElementById("form-product_id"),
        subproductSel = document.getElementById("form-subproduct_id");
    productSel.length = 1; // remove all options bar first
    subproductSel.length = 1; // remove all options bar first
    if (this.selectedIndex < 1) {
        productSel.options[0].text = "Select client";
        subproductSel.options[0].text = "Select product";
        return; // done
    }
    productSel.options[0].text = "Select client";
    for (producto in JSON.parse(json_productos)) {
        productSel.options[productSel.options.length] = new Option(producto.id, producto.title);
    }
    if (productSel.options.length===2) {
        productSel.selectedIndex=1;
        productSel.onchange();
    }
}

function callAjax(url, callback){
    var xmlhttp;
    // compatible with IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
            callback(xmlhttp.responseText);
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function productChange(){
    subproductSel.length = 1; // remove all options bar first
    if (this.selectedIndex < 1) {
        subproductSel.options[0].text = "Select client";
        return; // done
    }
    subproductSel.options[0].text = "Select product";

    var subproducts = clientsObject[clientSel.value][this.value];
    for (var i = 0; i < subproducts.length; i++) {
        subproductSel.options[subproductSel.options.length] = new Option(subproducts[i], subproducts[i]);
    }
    if (subproductSel.options.length===2) {
        subproductSel.selectedIndex=1;
        subproductSel.onchange();
    }
}

var clientsObject = getClientProductsJson();
