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
    var productSel = document.getElementById("form-product_id"),
        subproductSel = document.getElementById("form-subproduct_id");
    productSel.length = 0; // remove all options bar first
    subproductSel.length = 0; // remove all options bar first
    /*if (this.selectedIndex < 1) {
        productSel.options[0].text = "Select product";
        subproductSel.options[0].text = "Select subproduct";
        return; // done
    }
    productSel.options[0].text = "Select product";*/
    JSON.parse(json_productos).forEach(function(valor, indice, array) {
       productSel.options.add(new Option(valor['title'], valor['id']));
    });
    if (productSel.options.length===2) {
        productSel.selectedIndex=1;
        productSel.onchange();
    }
}

function productChange(json_subproductos){
    var subproductSel = document.getElementById("form-subproduct_id");
    subproductSel.length = 1; // remove all options bar first
    //subproductSel.options[0].text = "Select subproduct";

    JSON.parse(json_subproductos).forEach(function(valor, indice, array) {
        subproductSel.options[subproductSel.options.length] = new Option(valor['title'], valor['id']);
    });
    if (subproductSel.options.length===2) {
        subproductSel.selectedIndex=1;
        subproductSel.onchange();
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


var clientsObject = getClientProductsJson();
