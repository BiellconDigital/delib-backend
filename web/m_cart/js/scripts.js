$.superbox.settings = {
        boxId: "superbox", // Id attribute of the "superbox" element
        boxClasses: "", // Class of the "superbox" element
        overlayOpacity: .9, // Background opaqueness
        boxWidth: "1000", // Default width of the box
        boxHeight: "1000", // Default height of the box
        loadTxt: "Loading...", // Loading text
        closeTxt: "Cerrar", // "Close" button text
        prevTxt: "Previous", // "Previous" button text
        nextTxt: "Next" // "Next" button text
};

jQuery(cartInit);

//$(document).on("ready", cartInit);

function cartInit() {
    $.superbox();
//    alert("listo");
}

 function loadProducto(idprod) {
    $.post(Tonyprr.BASE_URL + '/cart/productos/detalle', { 'id': idprod }  , function(data) {
        $("#divSubContentProductsDet").mCustomScrollbar("update");
        try {
            $("#divSubContentProductsDet .mCSB_container").html(data);
            $("#divSubContentProductsDet").mCustomScrollbar("update");
        } catch(Exception){}
    });
    $("#titleProdAddc").load(Tonyprr.BASE_URL + '/cart/productos/ruta', { 'idprod': idprod } );
    setTimeout(function() {
        try {
        $("#divProdDetMenuVer").mCustomScrollbar("update");
//        $("#divProdDetMenuVer").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top
        } catch(Exception){}
    }, 1200);
}
 
function loadProductos(idcate) {
    $.post(Tonyprr.BASE_URL + '/cart/productos/lista', { 'cate': idcate }  , function(data) {
        try {
            $("#divSubContentProductsDet .mCSB_container").html(data);
            $("#divSubContentProductsDet").mCustomScrollbar("update");
        } catch(Exception){}
    });
    $("#titleProdAddc").load(Tonyprr.BASE_URL + '/cart/productos/ruta', { 'idcate': idcate });
    setTimeout(function() {
        try {
        $("#divProdDetMenuVer").mCustomScrollbar("update");
//        $("#divProdDetMenuVer").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top
        } catch(Exception){}
    }, 1200);
}
function loadCategorias(idcate) {
    $.post(Tonyprr.BASE_URL + '/cart/productos/categoria', { 'id': idcate }  , function(data) {
        try {
            $("#divSubContentProductsDet .mCSB_container").html(data);
            $("#divSubContentProductsDet").mCustomScrollbar("update");
        } catch(Exception){}
    });
    $("#titleProdAddc").load(Tonyprr.BASE_URL + '/cart/productos/ruta', { 'idcate': idcate } );
    setTimeout(function() {
        try {
        $("#divProdDetMenuVer").mCustomScrollbar("update");
//        $("#divProdDetMenuVer").mCustomScrollbar("scrollTo","top",{scrollInertia:200}); //scroll to top
        } catch(Exception){}
    }, 1200);
    
}
